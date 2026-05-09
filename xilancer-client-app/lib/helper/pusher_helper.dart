import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:crypto/crypto.dart';
import 'package:pusher_channels_flutter/pusher_channels_flutter.dart';
import 'package:xilancer/main.dart';
import 'package:xilancer/services/chat_credential_service.dart';
import 'package:xilancer/services/profile_info_service.dart';
import 'package:xilancer/services/conversation_service.dart';
import 'package:xilancer/services/user_mode_service.dart';
import 'package:xilancer/services/agora_call_service.dart';
import 'package:xilancer/views/voice_call_view/incoming_call_overlay.dart';
import 'package:xilancer/helper/notification_helper.dart';
import 'package:flutter_callkit_incoming/flutter_callkit_incoming.dart';

class PusherHelper {
  static final PusherHelper _instance = PusherHelper._internal();
  factory PusherHelper() => _instance;
  PusherHelper._internal();

  PusherChannelsFlutter pusher = PusherChannelsFlutter.getInstance();
  final List<String> _subscribedChannels = [];
  bool _isInitialized = false;

  BuildContext? get _globalContext => navigatorKey.currentContext;

  ChatCredentialService? get _credentials {
    if (_globalContext == null) return null;
    return Provider.of<ChatCredentialService>(_globalContext!, listen: false);
  }

  /// Fully shuts down Pusher (use only on Logout)
  Future<void> disconnectAll() async {
    debugPrint("PusherHelper: Full disconnect requested.");
    for (var channel in _subscribedChannels) {
      await pusher.unsubscribe(channelName: channel);
    }
    await pusher.disconnect();
    _subscribedChannels.clear();
    _isInitialized = false;
  }

  /// Alias for compatibility, but now safer — only unsubscribes chat channels
  Future<void> disConnect() async {
    debugPrint("PusherHelper: Selective disconnect (chat channels only).");
    final chatChannels = _subscribedChannels.where((c) => c.contains("private-livechat")).toList();
    for (var channel in chatChannels) {
      await unsubscribeFromChannel(channel);
    }
  }

  Future<void> unsubscribeFromChannel(String channelName) async {
    if (!_subscribedChannels.contains(channelName)) return;
    try {
      await pusher.unsubscribe(channelName: channelName);
      _subscribedChannels.remove(channelName);
      debugPrint("PusherHelper: Unsubscribed from $channelName");
    } catch (e) {
      debugPrint("PusherHelper ERROR: Failed to unsubscribe from $channelName: $e");
    }
  }

  /// Original method for conversation-specific chat
  Future<void> connectToPusher(BuildContext context, dynamic clientId, dynamic freelancerId) async {
    if (_credentials == null) return;
    final vendorChannel = "private-livechat-freelancer-channel.$clientId.$freelancerId";
    final clientChannel = "private-livechat-client-channel.$freelancerId.$clientId";


    final isFreelancer = UserModeService.instance.isFreelancer;
    final listenChannel = isFreelancer ? clientChannel : vendorChannel;

    await _initAndSubscribe(listenChannel);
  }

  /// Global method for user-specific signals (Calls, System notifications)
  Future<void> listenToUserSignals(dynamic userId) async {
    final userChannel = "private-user-incoming-call.$userId";
    await _initAndSubscribe(userChannel);
  }

  Future<void> _initAndSubscribe(String channelName) async {
    if (_subscribedChannels.contains(channelName)) return;
    if (_isInitialized && channelName.isEmpty) return; 

    // Retry logic if credentials are not ready yet
    ChatCredentialService? creds = _credentials;
    int retryCount = 0;
    while (creds == null && retryCount < 5) {
      debugPrint("PusherHelper: Credentials not ready, retrying in 1s... ($retryCount)");
      await Future.delayed(const Duration(seconds: 1));
      creds = _credentials;
      retryCount++;
    }

    if (creds == null) {
      debugPrint("PusherHelper ERROR: No credentials after retries. Aborting $channelName");
      return;
    }

    try {
      if (!_isInitialized) {
        _isInitialized = true; // Mark early to prevent parallel calls
        debugPrint("PusherHelper: Initializing Pusher with ${creds.appKey}");
        await pusher.init(
          apiKey: creds.appKey,
          cluster: creds.appCluster,
          onEvent: onEvent,
          onSubscriptionSucceeded: onSubscriptionSucceeded,
          onConnectionStateChange: onConnectionStateChange,
          onError: (s, i, d) => debugPrint("Pusher SDK Error: $s - $i - $d"),
          onAuthorizer: onAuthorizer,
        );
        await pusher.connect();
      }

      if (channelName.isNotEmpty) {
        debugPrint("PusherHelper: Subscribing to $channelName");
        await pusher.subscribe(channelName: channelName);
        if (!_subscribedChannels.contains(channelName)) {
          _subscribedChannels.add(channelName);
        }
      }
    } catch (e) {
      debugPrint("PusherHelper EXCEPTION: Subscription error for $channelName: $e");
    }
  }

  dynamic onAuthorizer(String channelName, String socketId, dynamic options) {
    final creds = _credentials;
    if (creds == null) return null;

    debugPrint("PusherHelper: Authorizing $channelName with socketId $socketId");
    var stringToSign = '$socketId:$channelName';
    var hmacSha256 = Hmac(sha256, utf8.encode(creds.appSecret));
    var digest = hmacSha256.convert(utf8.encode(stringToSign));

    final authString = "${creds.appKey}:$digest";
    debugPrint("PusherHelper: Auth string generated");

    return {
      "auth": authString,
    };
  }

  void onEvent(PusherEvent event) async {
    debugPrint("Pusher Event: ${event.eventName} on ${event.channelName}");
    if (event.data.isEmpty) return;

    final data = jsonDecode(event.data);
    final context = _globalContext;
    if (context == null) return;

    // Handle incoming call events
    // Handle incoming call events
    if (data['type'] == 'incoming_call') {
      try {
        final activeCalls = await FlutterCallkitIncoming.activeCalls();
        if (activeCalls is List && activeCalls.isNotEmpty) {
          debugPrint("PusherHelper: CallKit already has active calls, skipping duplicate trigger.");
          return;
        }

        final callService = Provider.of<AgoraCallService>(context, listen: false);
        if (callService.isInCall || callService.isRinging) {
          debugPrint("PusherHelper: Ignoring incoming call (already in call or ringing)");
          return;
        }
        callService.setRinging(true); // Set state IMMEDIATELY
        _handleIncomingCall(context, data);
      } catch (e) {
        debugPrint("PusherHelper: Error triggering incoming call: $e");
      }
      return;
    }

    // Handle call ended events
    if (data['type'] == 'call_ended') {
      debugPrint("PusherHelper: Call ended signaling received");
      try {
        Provider.of<AgoraCallService>(context, listen: false).leaveCall(notifyServer: false);
      } catch (e) {
        debugPrint("PusherHelper: Suppression of post-nav signaling error: $e");
      }
      return;
    }

    // Handle regular chat messages
    final messageReceived = data['message'];
    if (messageReceived != null) {
      Provider.of<ConversationService>(context, listen: false)
          .addNewMessage(messageReceived);
    }
  }

  void _handleIncomingCall(BuildContext context, Map<String, dynamic> data) {
    debugPrint("PusherHelper: Triggering native CallKit via showCallKitIncoming");
    showCallKitIncoming(data);
  }

  void onSubscriptionSucceeded(String channelName, dynamic data) {
    debugPrint("PusherHelper: Subscription Succeeded: $channelName");
  }

  void onConnectionStateChange(dynamic currentState, dynamic previousState) {
    debugPrint("Pusher Connection: $currentState");
  }
}

import 'dart:async';
import 'dart:convert';

import 'package:agora_rtc_engine/agora_rtc_engine.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:permission_handler/permission_handler.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/main.dart';
import 'package:flutter_callkit_incoming/flutter_callkit_incoming.dart';
import 'package:flutter_callkit_incoming/entities/entities.dart';
import 'package:xilancer/views/voice_call_view/voice_call_view.dart';

class AgoraCallService with ChangeNotifier {
  RtcEngine? _engine;
  bool _engineReady = false; // Tracks if engine is FULLY initialized
  bool _isInCall = false;
  bool _isMuted = false;
  bool _isSpeakerOn = true;
  bool _remoteUserJoined = false;
  int _callDurationSeconds = 0;
  Timer? _callTimer;
  String? _currentChannelName;
  int? _currentCallId;
  bool _isInitializingEngine = false;

  AgoraCallService() {
    _listenToCallKitEvents();
  }

  void _listenToCallKitEvents() {
    FlutterCallkitIncoming.onEvent.listen((CallEvent? event) async {
      if (event == null) return;
      
      switch (event.event) {
        case Event.actionCallAccept:
          debugPrint("CallKit: Action Accept");
          final extra = event.body['extra'] ?? {};
          final callId = extra['call_id'];
          final channelName = extra['channel_name'];
          final appId = extra['app_id'];
          final callerName = extra['caller_name'];
          final callerImage = extra['caller_image'];

          if (callId != null && channelName != null && appId != null) {
            final success = await acceptCall(
              callId is String ? int.parse(callId) : callId,
              channelName,
              appId,
            );
            if (success) {
              navigatorKey.currentState?.push(MaterialPageRoute(
                builder: (_) => VoiceCallView(
                  callerName: callerName ?? 'Bilinmeyen',
                  callerImage: callerImage,
                  isOutgoing: false,
                ),
              ));
            }
          }
          break;
        case Event.actionCallDecline:
          debugPrint("CallKit: Action Decline");
          final extra = event.body['extra'] ?? {};
          final callId = extra['call_id'];
          if (callId != null) {
            await declineCall(callId is String ? int.parse(callId) : callId);
          }
          break;
        case Event.actionCallEnded:
          debugPrint("CallKit: Action End");
          await leaveCall();
          break;
        default:
          break;
      }
    });
  }

  // Getters
  bool get isInCall => _isInCall;
  bool get isMuted => _isMuted;
  bool get isSpeakerOn => _isSpeakerOn;
  bool get remoteUserJoined => _remoteUserJoined;
  int get callDurationSeconds => _callDurationSeconds;
  String? get currentChannelName => _currentChannelName;
  int? get currentCallId => _currentCallId;

  String get formattedDuration {
    final minutes = (_callDurationSeconds ~/ 60).toString().padLeft(2, '0');
    final seconds = (_callDurationSeconds % 60).toString().padLeft(2, '0');
    return '$minutes:$seconds';
  }

  /// Request microphone permission
  Future<bool> requestPermissions() async {
    final status = await Permission.microphone.request();
    return status.isGranted;
  }

  /// Initialize Agora RTC engine (singleton — created once, reused)
  Future<bool> _initEngine(String appId) async {
    // If already fully ready, skip
    if (_engine != null && _engineReady) {
      debugPrint('Agora: Engine already initialised & ready — reusing.');
      return true;
    }

    // Mutex: prevent parallel init calls
    if (_isInitializingEngine) {
      debugPrint('Agora: Init already in progress — waiting…');
      while (_isInitializingEngine) {
        await Future.delayed(const Duration(milliseconds: 100));
      }
      return _engineReady;
    }

    if (appId.isEmpty) {
      debugPrint('Agora: CRITICAL — appId is empty!');
      return false;
    }

    _isInitializingEngine = true;

    try {
      // If a previous attempt left a broken engine, clean it up first
      if (_engine != null && !_engineReady) {
        debugPrint('Agora: Cleaning up broken engine from previous attempt…');
        try {
          await _engine!.release();
        } catch (_) {}
        _engine = null;
      }

      debugPrint('Agora init 1/4: createAgoraRtcEngine');
      _engine = createAgoraRtcEngine();

      debugPrint('Agora init 2/4: initialize');
      await _engine!.initialize(RtcEngineContext(
        appId: appId,
        channelProfile: ChannelProfileType.channelProfileCommunication,
      ));

      debugPrint('Agora init 3/4: registerEventHandler');
      _engine!.registerEventHandler(RtcEngineEventHandler(
        onJoinChannelSuccess: (RtcConnection connection, int elapsed) {
          debugPrint('Agora CB: joined channel ${connection.channelId}');
          _isInCall = true;
          notifyListeners();
        },
        onUserJoined: (RtcConnection connection, int remoteUid, int elapsed) {
          debugPrint('Agora CB: remote user $remoteUid joined');
          _remoteUserJoined = true;
          _startCallTimer();
          notifyListeners();
        },
        onUserOffline:
            (RtcConnection connection, int remoteUid, UserOfflineReasonType reason) {
          debugPrint('Agora CB: remote user $remoteUid left ($reason)');
          _remoteUserJoined = false;
          notifyListeners();
          leaveCall();
        },
        onError: (ErrorCodeType err, String msg) {
          debugPrint('Agora CB onError: $err — $msg');
        },
        onTokenPrivilegeWillExpire: (RtcConnection connection, String token) {
          debugPrint('Agora CB: token will expire');
        },
      ));

      debugPrint('Agora init 4/4: enableAudio');
      await _engine!.enableAudio();

      // Speaker is non-critical — failing here must NOT break the whole init
      try {
        await _engine!.setEnableSpeakerphone(true);
      } catch (e) {
        debugPrint('Agora: setEnableSpeakerphone failed (non-critical): $e');
      }

      _engineReady = true;
      debugPrint('Agora: Engine initialisation COMPLETE ✓');
      return true;
    } catch (e) {
      debugPrint('Agora INIT ERROR: $e');
      // Engine is NOT usable — clean up so next attempt starts fresh
      try {
        await _engine?.release();
      } catch (_) {}
      _engine = null;
      _engineReady = false;
      return false;
    } finally {
      _isInitializingEngine = false;
    }
  }

  // ─────────────────────────── Outgoing call ───────────────────────────

  Future<Map<String, dynamic>?> initiateCall(int receiverId,
      {int? liveChatId}) async {
    final hasPermission = await requestPermissions();
    if (!hasPermission) {
      debugPrint('Agora: Microphone permission denied');
      return null;
    }

    try {
      final response = await http.post(
        Uri.parse(AppUrls.agoraInitiateCallUrl),
        headers: {...acceptJsonAuthHeader, 'Content-Type': 'application/json'},
        body: jsonEncode({
          'receiver_id': receiverId,
          'live_chat_id': liveChatId,
        }),
      );

      debugPrint('Agora initiateCall response: ${response.statusCode}');
      debugPrint('Agora initiateCall body: ${response.body}');

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        _currentCallId = data['call_id'];
        _currentChannelName = data['channel_name'];

        final engineOk = await _initEngine(data['app_id']?.toString() ?? '');
        if (!engineOk || _engine == null) {
          debugPrint('Agora: Engine init failed — aborting call.');
          return null;
        }

        debugPrint(
            'Agora: joining channel=${data['channel_name']}  uid=${data['caller_id']}');
        await _engine!.joinChannel(
          token: data['token'],
          channelId: data['channel_name'],
          uid: data['caller_id'],
          options: const ChannelMediaOptions(
            channelProfile: ChannelProfileType.channelProfileCommunication,
            clientRoleType: ClientRoleType.clientRoleBroadcaster,
            autoSubscribeAudio: true,
            publishMicrophoneTrack: true,
          ),
        );

        return data;
      } else {
        debugPrint('Agora: initiateCall HTTP ${response.statusCode}');
      }
    } catch (e) {
      debugPrint('Agora: Error initiating call: $e');
    }
    return null;
  }

  // ─────────────────────────── Accept call ───────────────────────────

  Future<bool> acceptCall(int callId, String channelName, String appId) async {
    final hasPermission = await requestPermissions();
    if (!hasPermission) return false;

    try {
      final response = await http.post(
        Uri.parse(AppUrls.agoraAcceptCallUrl),
        headers: {...acceptJsonAuthHeader, 'Content-Type': 'application/json'},
        body: jsonEncode({
          'call_id': callId,
          'channel_name': channelName,
        }),
      );

      debugPrint('Agora acceptCall response: ${response.statusCode}');
      debugPrint('Agora acceptCall body: ${response.body}');

      if (response.statusCode == 200) {
        final data = jsonDecode(response.body);
        _currentCallId = callId;
        _currentChannelName = channelName;

        final engineOk = await _initEngine(data['app_id']?.toString() ?? '');
        if (!engineOk || _engine == null) {
          debugPrint('Agora: Engine init failed — cannot accept call.');
          return false;
        }

        debugPrint(
            'Agora: joining channel=${data['channel_name']}  uid=${data['uid']}');
        await _engine!.joinChannel(
          token: data['token'],
          channelId: data['channel_name'],
          uid: data['uid'],
          options: const ChannelMediaOptions(
            channelProfile: ChannelProfileType.channelProfileCommunication,
            clientRoleType: ClientRoleType.clientRoleBroadcaster,
            autoSubscribeAudio: true,
            publishMicrophoneTrack: true,
          ),
        );

        return true;
      } else {
        debugPrint('Agora: acceptCall HTTP ${response.statusCode}');
      }
    } catch (e) {
      debugPrint('Agora: Error accepting call: $e');
    }
    return false;
  }

  bool _isLeaving = false;
  bool _isRinging = false;

  bool get isRinging => _isRinging;

  void setRinging(bool value) {
    _isRinging = value;
    notifyListeners();
  }

  // ─────────────────────────── Leave call ───────────────────────────
  Future<void> leaveCall({bool notifyServer = true}) async {
    if (_isLeaving) return;
    if (!_isInCall && !_isRinging) return;

    _isLeaving = true;
    debugPrint("AgoraCallService: leaveCall(notifyServer: $notifyServer)");

    // 1. Stop local UI/Signals
    _stopCallTimer();
    if (_isRinging) {
      _isRinging = false;
      await FlutterCallkitIncoming.endAllCalls();
      // Only pop if we are sure the overlay is showing
      try {
        if (navigatorKey.currentState?.canPop() ?? false) {
          navigatorKey.currentState?.pop();
        }
      } catch (e) {
        debugPrint("AgoraCallService: Error popping ringing overlay: $e");
      }
    }

    // 2. Notify server if requested
    if (notifyServer && _currentCallId != null) {
      final callIdToNotify = _currentCallId;
      _currentCallId = null; // Clear immediately to prevent repeat calls
      try {
        await http.post(
          Uri.parse(AppUrls.agoraEndCallUrl),
          headers: {
            ...acceptJsonAuthHeader,
            'Content-Type': 'application/json',
          },
          body: jsonEncode({'call_id': callIdToNotify}),
        );
      } catch (e) {
        debugPrint('Agora: Error ending call on server: $e');
      }
    }

    // 3. Cleanup Engine
    try {
      await _engine?.leaveChannel();
    } catch (e) {
      debugPrint('Agora: Error leaving channel: $e');
    }

    // Reset State
    _isInCall = false;
    _isMuted = false;
    _isSpeakerOn = true;
    _remoteUserJoined = false;
    _callDurationSeconds = 0;
    _currentCallId = null;
    _currentChannelName = null;
    _isLeaving = false;
    notifyListeners();
  }

  // ─────────────────────────── Decline call ───────────────────────────

  Future<void> declineCall(int callId) async {
    try {
      await http.post(
        Uri.parse(AppUrls.agoraDeclineCallUrl),
        headers: {
          ...acceptJsonAuthHeader,
          'Content-Type': 'application/json',
        },
        body: jsonEncode({'call_id': callId}),
      );
    } catch (e) {
      debugPrint('Agora: Error declining call: $e');
    }
  }

  // ─────────────────────────── Controls ───────────────────────────

  void toggleMute() {
    _isMuted = !_isMuted;
    _engine?.muteLocalAudioStream(_isMuted);
    notifyListeners();
  }

  void toggleSpeaker() {
    _isSpeakerOn = !_isSpeakerOn;
    _engine?.setEnableSpeakerphone(_isSpeakerOn);
    notifyListeners();
  }

  // ─────────────────────────── Timer ───────────────────────────

  void _startCallTimer() {
    _callDurationSeconds = 0;
    _callTimer?.cancel();
    _callTimer = Timer.periodic(const Duration(seconds: 1), (_) {
      _callDurationSeconds++;
      notifyListeners();
    });
  }

  void _stopCallTimer() {
    _callTimer?.cancel();
    _callTimer = null;
  }

  @override
  void dispose() {
    _stopCallTimer();
    _engine?.release();
    super.dispose();
  }
}

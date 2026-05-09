import 'dart:convert';
import 'dart:developer';

import 'package:firebase_core/firebase_core.dart';
import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_local_notifications/flutter_local_notifications.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:xilancer/app.dart';
import 'package:timeago/timeago.dart' as timeago;

import 'helper/firebase_messaging_helper.dart';
import 'helper/notification_helper.dart';
import 'services/user_mode_service.dart';
import 'package:flutter_callkit_incoming/flutter_callkit_incoming.dart';
import 'package:flutter_callkit_incoming/entities/entities.dart';
import 'package:uuid/uuid.dart';

@pragma('vm:entry-point')
Future<void> firebaseMessagingBackgroundHandler(RemoteMessage message) async {
  await Firebase.initializeApp();

  await setupFlutterNotifications();
  final messageData = message.data;
  final sPref = await SharedPreferences.getInstance();
  final strings = sPref.getString('translated_string') ?? "{}";
  var translatedString = jsonDecode(strings);
  final id = messageData['id'] is String
      ? int.tryParse(messageData['id'])
      : messageData['id'];

  String title = message.data['title'] ?? "";
  String description = message.data['body'] ?? "";
  String identity = message.data['identity'] ?? "";
  String type = message.data['type'] ?? "name";
  if (type == "Order") {
    title = description;
    description = "${translatedString["Order Id"] ?? "Order Id"}: #$identity";
  }
  if (type == "Withdraw") {
    title = description;
    description = "${translatedString["Id"] ?? "Id"}: #$identity";
  }
  if (type == "incoming_call") {
    final activeCalls = await FlutterCallkitIncoming.activeCalls();
    if (activeCalls is List && activeCalls.isNotEmpty) {
      debugPrint(
          "BackgroundHandler: Call already active, skipping duplicate CallKit trigger.");
      return;
    }

    title = message.data['title'] ?? "Gelen Sesli Arama";
    description = message.data['body'] ?? "Sizi arıyor...";

    // Trigger CallKit
    final uuid = const Uuid().v4();
    final callId = messageData['call_id'] is String
        ? int.parse(messageData['call_id'])
        : messageData['call_id'];

    CallKitParams params = CallKitParams(
      id: uuid,
      nameCaller: messageData['caller_name'] ?? 'Bilinmeyen',
      appName: 'yaptiriyo',
      avatar: messageData['caller_image'],
      handle: 'Sesli Arama',
      type: 0,
      duration: 30000,
      textAccept: 'Kabul Et',
      textDecline: 'Reddet',
      extra: <String, dynamic>{
        ...messageData,
        'call_id': callId,
      },
      android: const AndroidParams(
        isCustomNotification: true,
        isShowLogo: false,
        ringtonePath: 'system_ringtone_default',
        backgroundColor: '#1a1a2e',
        isShowFullLockedScreen: true,
      ),
      ios: const IOSParams(
        iconName: 'CallKitIcon',
        handleType: 'generic',
        ringtonePath: 'system_ringtone_default',
      ),
    );
    await FlutterCallkitIncoming.showCallkitIncoming(params);
  }
  if (type == "call_ended") {
    // Clear notifications if call ended
    await flutterLocalNotificationsPlugin.cancelAll();
    return;
  }
  if (type == "message") {
    var liveChatData = jsonDecode(message.data["livechat"] ?? "{}");
    // log(message.data.toString());
    try {
      log(message.data['body'].toString());
      description =
          jsonDecode(message.data['body'] ?? "{}")?["message"]?.toString() ??
              "";
    } catch (e) {
      debugPrint("error is this $e".toString());
    }
  }
  NotificationHelper().triggerNotification(
      id: id, body: description, title: title, payload: message.data);
}

final navigatorKey = GlobalKey<NavigatorState>(debugLabel: "nav_key");
void main() async {
  WidgetsFlutterBinding.ensureInitialized();

  await Firebase.initializeApp();

  final DarwinInitializationSettings initializationSettingsDarwin =
      DarwinInitializationSettings(
    requestAlertPermission: true,
    requestBadgePermission: true,
    requestSoundPermission: true,
    onDidReceiveLocalNotification: (id, title, body, payload) {},
  );

  const AndroidNotificationChannel channel = AndroidNotificationChannel(
    'high_importance_channel',
    'High Importance Notifications',
    description: 'This channel is used for important notifications.',
    importance: Importance.high,
  );

  await flutterLocalNotificationsPlugin.initialize(
    InitializationSettings(
      android: const AndroidInitializationSettings('notification_icon'),
      iOS: initializationSettingsDarwin,
    ),
    onDidReceiveBackgroundNotificationResponse: staticFuctionOnForground,
    onDidReceiveNotificationResponse: staticFuctionOnForground,
  );

  // Request iOS local notification permissions
  await flutterLocalNotificationsPlugin
      .resolvePlatformSpecificImplementation<
          IOSFlutterLocalNotificationsPlugin>()
      ?.requestPermissions(
        alert: true,
        badge: true,
        sound: true,
      );

  final AndroidFlutterLocalNotificationsPlugin? androidImplementation =
      flutterLocalNotificationsPlugin.resolvePlatformSpecificImplementation<
          AndroidFlutterLocalNotificationsPlugin>();

  // final bool? granted = await androidImplementation?.requestPermission();
  FirebaseMessaging.onBackgroundMessage(firebaseMessagingBackgroundHandler);

  if (!kIsWeb) {
    await setupFlutterNotifications();
  }

  setNotificationDetails(
      await flutterLocalNotificationsPlugin.getNotificationAppLaunchDetails());
  debugPrint((notificationDetails?.notificationResponse?.payload).toString());

  await UserModeService.instance.initializeMode();

  timeago.setLocaleMessages('tr', timeago.TrMessages());

  runApp(const XilancerApp());
}

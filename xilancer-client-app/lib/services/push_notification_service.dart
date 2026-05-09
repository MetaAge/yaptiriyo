import 'dart:io';

import 'package:firebase_messaging/firebase_messaging.dart';
import 'package:flutter/material.dart';

import '../data/network/network_api_services.dart';
import '../helper/app_urls.dart';
import '../helper/constant_helper.dart';

class PushNotificationService {
  String? userToken;

  setUserToken(value) {
    userToken = value;
  }

  updateDeviceToken({bool forceUpdate = false}) async {
    String? localToken = sPref?.getString("device_token") ?? "";

    String? uToken;

    FirebaseMessaging messaging = FirebaseMessaging.instance;
    try {
      if (Platform.isIOS) {
        await messaging.getAPNSToken();
        uToken = await messaging.getToken();
      } else {
        uToken = await messaging.getToken();
      }
    } catch (e) {}

    if ((uToken?.isEmpty ?? true) && (userToken?.isEmpty ?? true)) {
      debugPrint("PushNotificationService: No FCM token available yet, skipping sync.");
      return;
    }

    final finalToken = userToken ?? uToken ?? "";

    if (finalToken == localToken && !forceUpdate) {
      debugPrint("PushNotificationService: Token matches local, skipping sync.");
      return;
    }
    setUserToken(finalToken);
    sPref?.setString("device_token", finalToken);
    final data = {"token": finalToken};
    debugPrint("PushNotificationService: Syncing token: $finalToken");
    final responseData = await NetworkApiServices().postApi(
      data,
      AppUrls.fcmTokenUrl,
      null,
      headers: acceptJsonAuthHeader,
    );
    debugPrint(responseData.toString());
    if (responseData != null) {
      sPref?.setString("device_token", finalToken);
    }
  }
}

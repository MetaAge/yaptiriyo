import 'package:firebase_messaging/firebase_messaging.dart';

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
      await messaging.getAPNSToken();
      uToken = await messaging.getToken();
    } catch (e) {}

    if (uToken == localToken && !forceUpdate) {
      return;
    }
    setUserToken(userToken);
    sPref?.setString("device_token", userToken ?? uToken ?? "");
    final data = {"token": userToken ?? uToken ?? ""};
    final responseData = await NetworkApiServices().postApi(
      data,
      AppUrls.fcmTokenUrl,
      null,
      headers: acceptJsonAuthHeader,
    );

    if (responseData != null) {
      sPref?.setString("device_token", userToken ?? uToken ?? "");
    }
  }
}

import 'package:flutter/material.dart';
import 'package:xilancer/services/user_mode_service.dart';
import '../../data/network/network_api_services.dart';
import '../../helper/app_urls.dart';
import '../../helper/constant_helper.dart';
import '../../helper/extension/string_extension.dart';
import '../../helper/local_keys.g.dart';

class SignInService with ChangeNotifier {
  bool emailVerified = true;
  var emailToken = "";
  var token = "";
  var email = "";
  var userId = "";
  Future trySignIn(
      {required String emailUsername, required String password}) async {
    final data = {'email_or_username': emailUsername, 'password': password};

    dynamic responseData;
    final originalMode = UserModeService.instance.currentMode;

    try {
      // First attempt with selected mode
      responseData = await NetworkApiServices().postApi(
        data,
        AppUrls.signInUrl,
        null, // Suppress error toast for retry
      );
    } catch (e) {
      debugPrint("First login attempt failed, trying other mode...");
    }

    // If first attempt fails (null or no token), try the other mode
    if (responseData == null || !responseData.containsKey("token")) {
      try {
        UserModeService.instance.toggleMode();
        responseData = await NetworkApiServices().postApi(
          data,
          AppUrls.signInUrl,
          null, // Suppress error toast
        );
      } catch (e) {
        // Both failed, revert mode and show error
        UserModeService.instance.setMode(originalMode);
        e.toString().showToast();
        return;
      }

      // If second attempt also fails (returns null without throwing)
      if (responseData == null || !responseData.containsKey("token")) {
        UserModeService.instance.setMode(originalMode);
        if (responseData != null && responseData.containsKey("message")) {
          responseData["message"]?.toString().showToast();
        } else {
          LocalKeys.emailUsernameValidateText.showToast();
        }
        return;
      }
    }

    if (responseData != null && responseData.containsKey("token")) {
      LocalKeys.signedInSuccessfully.showToast();
      token = responseData["token"] ?? "";
      final user = responseData["user"];
      if (user != null) {
        emailVerified = user["is_email_verified"].toString() == "1" ||
            user["is_email_verified"] == 1;
        emailToken = user["email_verify_token"]?.toString() ?? "";
        email = user["email"] ?? "";
        userId = user["id"]?.toString() ?? "";
      } else {
        emailVerified = true;
      }
      debugPrint("Login success. Email verified: $emailVerified");
      return emailVerified;
    } else if (responseData != null && responseData.containsKey("message")) {
      responseData["message"]?.toString().showToast();
      return null;
    }
    return null;
  }
}

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/services/auth/sign_up_service.dart';
import 'package:xilancer/services/profile_info_service.dart';

import '/helper/extension/context_extension.dart';
import '/helper/local_keys.g.dart';
import '../../customizations.dart';
import '../../helper/constant_helper.dart';
import '../../services/auth/sign_in_service.dart';
import '../../services/chat_credential_service.dart';
import '../../services/module_list_service.dart';
import '../../services/push_notification_service.dart';
import '../../view_models/onboarding_view_model/onboarding_view_model.dart';
import '../../views/onboarding_view/onboarding_view.dart';
import '../../views/reset_password/enter_otp_view.dart';
import '../../helper/pusher_helper.dart';

class SignInViewModel {
  final GlobalKey<FormState> formKey = GlobalKey();
  final ValueNotifier obscurePass = ValueNotifier<bool>(true);
  final ValueNotifier rememberPass = ValueNotifier<bool>(true);
  final ValueNotifier loading = ValueNotifier<bool>(false);
  final TextEditingController emailUsernameController = TextEditingController();
  final TextEditingController passwordController = TextEditingController();

  SignInViewModel._init();
  static SignInViewModel? _instance;
  static SignInViewModel get instance {
    _instance ??= SignInViewModel._init();
    return _instance!;
  }

  static get dispose {
    _instance = null;
    return true;
  }

  passwordValidator(BuildContext context, value) {
    if (value == null ||
        value.isEmpty ||
        value.trim().isEmpty ||
        value.length < 6) {
      return LocalKeys.passwordValidateText;
    }
    return null;
  }

  setUserInfo({email, pass}) async {
    sPref?.setString("user-email", email ?? "");
    sPref?.setString("user-pass", pass ?? "");
    sPref?.setBool("user-remember", rememberPass.value);
  }

  emailUsernameValidator(value) {
    if (value == null || value.isEmpty || value.trim().isEmpty) {
      return asProvider.getString(LocalKeys.emailUsernameValidateText);
    }
    return null;
  }

  initSavedInfo() {
    if (siteLink.contains("xilancer.xgenious.com")) {
      emailUsernameController.text =
          sPref?.getString("user-email") ?? "freelancer";
      passwordController.text = sPref?.getString("user-pass") ?? "12345678";
      rememberPass.value = sPref?.getBool("user-remember") ?? true;
    } else {
      emailUsernameController.text = sPref?.getString("user-email") ?? "";
      passwordController.text = sPref?.getString("user-pass") ?? "";
      rememberPass.value = sPref?.getBool("user-remember") ?? true;
    }
  }

  signIn(BuildContext context) async {
    final isValid = formKey.currentState?.validate();

    if (isValid == false) {
      return;
    }
    context.unFocus;
    if (rememberPass.value == true) {
      setUserInfo(
        email: emailUsernameController.text,
        pass: passwordController.text,
      );
    } else {
      setUserInfo();
    }
    loading.value = true;
    final siProvider = Provider.of<SignInService>(context, listen: false);
    final piProvider = Provider.of<ProfileInfoService>(context, listen: false);
    siProvider
        .trySignIn(
          emailUsername: emailUsernameController.text,
          password: passwordController.text,
        )
        .then((value) async {
          if (value == true) {
            final si = Provider.of<SignInService>(context, listen: false);
            final piProvider =
                Provider.of<ProfileInfoService>(context, listen: false);
            final chatService =
                Provider.of<ChatCredentialService>(context, listen: false);
            final moduleService =
                Provider.of<ModuleListService>(context, listen: false);

            setToken(si.token);
            loading.value = false;
            context.toUntilPage(const OnboardingView());

            // Background tasks
            try {
              chatService.fetchCredentials();
              moduleService.fetchModuleList();
              piProvider.fetchProfileInfo().then((_) {
                final userId = piProvider.profileInfoModel.data?.id;
                if (userId != null) {
                  PusherHelper().listenToUserSignals(userId);
                }
              });
              PushNotificationService().updateDeviceToken();
            } catch (e) {
              debugPrint("Error during background initialization: $e");
            }
          } else if (value == false) {
            final si = Provider.of<SignInService>(context, listen: false);
            context.toPage(
              EnterOtpView(si.emailToken, email: si.email, fromRegister: true),
              then: (otp) async {
                final su = Provider.of<SignUpService>(context, listen: false);
                if (si.emailToken == otp) {
                  await su.tryConfirmingEmail(otpCode: otp, id: si.userId).then(
                    (value) async {
                      if (value == true) {
                        setToken(si.token);
                        loading.value = false;
                        context.toUntilPage(const OnboardingView());

                        // Background tasks
                        try {
                          Provider.of<ChatCredentialService>(context,
                                  listen: false)
                              .fetchCredentials();
                          Provider.of<ModuleListService>(context, listen: false)
                              .fetchModuleList();
                          piProvider.fetchProfileInfo().then((_) {
                            final userId = piProvider.profileInfoModel.data?.id;
                            if (userId != null) {
                              PusherHelper().listenToUserSignals(userId);
                            }
                          });
                          PushNotificationService().updateDeviceToken(
                            forceUpdate: true,
                          );
                        } catch (e) {
                          debugPrint(
                              "Error during background OTP initialization: $e");
                        }
                      }
                    },
                  );
                } else {
                  loading.value = false;
                }
              },
            );
          } else {
            loading.value = false;
          }
        });
  }
}

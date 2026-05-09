import 'dart:io';

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/profile_info_service.dart';

import '../../models/payment_gateway_model.dart';
import '../../services/wallet_depost_service.dart';
import '../../views/onboarding_view/onboarding_view.dart';
import '../../views/proccess_status_view/proccess_status_view.dart';
import '../../services/payment/iyzipay_payment.dart';
import '../onboarding_view_model/onboarding_view_model.dart';
import '../../views/payment_views/payment_methode_navigator_helper.dart';

class WalletDepositViewModel {
  TextEditingController amountController = TextEditingController();

  ValueNotifier<bool> tacPP = ValueNotifier(false);
  ValueNotifier<bool> isLoading = ValueNotifier(false);
  ValueNotifier<Gateway?> selectedGateway = ValueNotifier(null);
  ValueNotifier<File?> selectedAttachment = ValueNotifier(null);
  TextEditingController descriptionController = TextEditingController();

  TextEditingController aCardController = TextEditingController();
  TextEditingController zUsernameController = TextEditingController();
  TextEditingController authCodeController = TextEditingController();

  ValueNotifier<DateTime?> authNetExpireDate = ValueNotifier(null);

  WalletDepositViewModel._init();
  static WalletDepositViewModel? _instance;
  static WalletDepositViewModel get instance {
    _instance ??= WalletDepositViewModel._init();
    return _instance!;
  }

  WalletDepositViewModel._dispose();
  static bool get dispose {
    _instance = null;
    return true;
  }

  tryDeposit(BuildContext context) async {
    if (selectedGateway.value == null) {
      LocalKeys.selectAPaymentMethod.showToast();
      return;
    }
    if (!paymentValidate) {
      return;
    }
    isLoading.value = true;
    final responseData =
        await Provider.of<WalletDepositService>(context, listen: false)
            .tryDeposit(selectedAttachment.value);
    if (responseData == null) {
      isLoading.value = false;
      return;
    }

    final wd = Provider.of<WalletDepositService>(context, listen: false);
    final pi = Provider.of<ProfileInfoService>(context, listen: false);

    final userEmail = pi.profileInfoModel.data?.email;
    final userPhone = pi.profileInfoModel.data?.phone;
    final userName = pi.profileInfoModel.data?.firstName;
    final userCity = pi.profileInfoModel.data?.city;
    final userAddress = pi.profileInfoModel.data?.city;
    final id = wd.id;
    void onSuccess() {
      bool isIyzipay = selectedGateway.value?.name == 'iyzipay';
      context.toPage(ProcessStatusView(
          title: LocalKeys.paymentSuccessful,
          updateStatus: !isIyzipay,
          ebText: LocalKeys.backToHome,
          ebOnTap: (BuildContext context) {
            OnboardingViewModel.dispose;
            context.toUntilPage(const OnboardingView());
          },
          onWillPop: (BuildContext context) {
            OnboardingViewModel.dispose;
            context.toUntilPage(const OnboardingView());
          },
          updateFunction: isIyzipay ? null : wd.updateDepositPayment,
          status: 1));
    }

    void onFailed([errorMessage]) {
      context.toPage(ProcessStatusView(
          title: LocalKeys.paymentFailed,
          description: errorMessage,
          updateStatus: false,
          ebText: LocalKeys.backToHome,
          ebOnTap: (BuildContext context) {
            OnboardingViewModel.dispose;
            context.toUntilPage(const OnboardingView());
          },
          onWillPop: (BuildContext context) {
            OnboardingViewModel.dispose;
            context.toUntilPage(const OnboardingView());
          },
          status: 0));
    }

    if (selectedGateway.value?.name == 'iyzipay') {
      isLoading.value = false;
      if (responseData['requires_3ds'] == true &&
          responseData['threeds_html'] != null) {
        context.toPage(IyzipayPayment(
          htmlContent: responseData['threeds_html'],
          orderId: wd.id.toString(),
          onSuccess: onSuccess,
          onFailed: onFailed,
          paymentType: 'wallet',
        ));
        return;
      } else if (responseData['deposit_details'] != null) {
        onSuccess();
        return;
      }
    }

    if (selectedGateway.value?.name == "manual_payment") {
      isLoading.value = false;
      context.toPage(ProcessStatusView(
          title: LocalKeys.depositSuccessful,
          updateStatus: false,
          description: id != null ? "${LocalKeys.orderId}: #$id" : null,
          ebText: LocalKeys.backToHome,
          ebOnTap: (BuildContext context) {
            OnboardingViewModel.dispose;
            context.toUntilPage(const OnboardingView());
          },
          onWillPop: (BuildContext context) {
            OnboardingViewModel.dispose;
            context.toUntilPage(const OnboardingView());
          },
          status: 1));
      return;
    }
    await startPayment(
      context,
      authNetCard: aCardController.text,
      authcCode: aCardController.text,
      zUsername: zUsernameController.text,
      authNetED: authNetExpireDate.value,
      onSuccess: onSuccess,
      onFailed: onFailed,
      orderId: wd.id,
      amount: amountController.text.tryToParse,
      selectedGateway: selectedGateway.value!,
      userEmail: userEmail,
      userName: userName,
      userPhone: userPhone,
      userCity: userCity,
      userAddress: userAddress,
      paymentType: 'wallet',
    );
    isLoading.value = false;
  }

  bool get paymentValidate {
    bool valid = true;
    switch (selectedGateway.value?.name) {
      case "authorize_dot_net":
        if (authCodeController.text.length < 3 ||
            aCardController.text.length < 16 ||
            authNetExpireDate.value == null) {
          LocalKeys.pleaseProvideYourCardInformation.showToast();
          return false;
        }
        break;
      case "manual_payment":
        if (selectedAttachment.value == null) {
          LocalKeys.selectFile.showToast();
          return false;
        }
        break;
      case "zitopay":
        if (zUsernameController.text.isEmpty) {
          LocalKeys.enterUsername.showToast();
          return false;
        }
        break;
      default:
    }
    return valid;
  }
}

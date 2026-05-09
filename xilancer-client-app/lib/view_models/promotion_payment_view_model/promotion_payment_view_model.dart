import 'dart:io';

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/services/promotion_manage_service.dart';

import '../../helper/local_keys.g.dart';
import '../../models/payment_gateway_model.dart';
import '../../models/promotion_packages_model.dart';
import '../../services/profile_info_service.dart';
import '../../views/onboarding_view/onboarding_view.dart';
import '../../views/payment_views/payment_methode_navigator_helper.dart';
import '../../views/proccess_status_view/proccess_status_view.dart';
import '../../services/payment/iyzipay_payment.dart';

class PromotionPaymentViewModel {
  ValueNotifier<bool> walletSelect = ValueNotifier(false);
  ValueNotifier<bool> tacPP = ValueNotifier(false);
  ValueNotifier<bool> isLoading = ValueNotifier(false);
  ValueNotifier<Gateway?> selectedGateway = ValueNotifier(null);
  ValueNotifier<File?> selectedAttachment = ValueNotifier(null);
  TextEditingController milestoneDescriptionController =
      TextEditingController();
  TextEditingController revisionController = TextEditingController();
  TextEditingController aCardController = TextEditingController();
  TextEditingController zUsernameController = TextEditingController();
  TextEditingController authCodeController = TextEditingController();

  ValueNotifier<DateTime?> authNetExpireDate = ValueNotifier(null);
  ValueNotifier<PromotionPackages?> selectedPackage = ValueNotifier(null);

  dynamic _id;
  dynamic _type;
  dynamic _identity;

  get id => _id;
  get type => _type;
  get identity => _identity;

  PromotionPaymentViewModel._init();
  static PromotionPaymentViewModel? _instance;
  static PromotionPaymentViewModel get instance {
    _instance ??= PromotionPaymentViewModel._init();
    return _instance!;
  }

  PromotionPaymentViewModel._dispose();
  static bool get dispose {
    _instance = null;
    return true;
  }

  tryPromotionBuy(BuildContext context) async {
    if (selectedGateway.value == null && !walletSelect.value) {
      LocalKeys.selectAPaymentMethod.showToast();
      return;
    }
    if (!paymentValidate) {
      return;
    }
    final pmProvider =
        Provider.of<PromotionManageService>(context, listen: false);
    isLoading.value = true;
    final responseData = await pmProvider.tryPromoting();
    if (responseData == null) {
      isLoading.value = false;
      return;
    }

    final sb = Provider.of<PromotionManageService>(context, listen: false);
    final pi = Provider.of<ProfileInfoService>(context, listen: false);

    final userEmail = pi.profileInfoModel.data?.email;
    final userPhone = pi.profileInfoModel.data?.phone;
    final userName = pi.profileInfoModel.data?.firstName;
    final userCity = pi.profileInfoModel.data?.city;
    final userAddress = pi.profileInfoModel.data?.city;
    final id = sb.id;

    void onSuccess() {
      bool isIyzipay = selectedGateway.value?.name == 'iyzipay';
      context.toPage(ProcessStatusView(
          title: LocalKeys.paymentSuccessful,
          updateStatus: !isIyzipay,
          ebText: LocalKeys.backToHome,
          ebOnTap: (BuildContext context) {
            context.toUntilPage(const OnboardingView());
          },
          onWillPop: (BuildContext context) {
            context.toUntilPage(const OnboardingView());
          },
          updateFunction: isIyzipay ? null : sb.updatePromotePayment,
          status: 1));
    }

    void onFailed([errorMessage]) {
      context.toPage(ProcessStatusView(
          title: LocalKeys.paymentFailed,
          description: errorMessage,
          updateStatus: false,
          ebText: LocalKeys.backToHome,
          ebOnTap: (BuildContext context) {
            context.toUntilPage(const OnboardingView());
          },
          onWillPop: (BuildContext context) {
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
          orderId: sb.id.toString(),
          onSuccess: onSuccess,
          onFailed: onFailed,
          paymentType: 'promotion',
        ));
        return;
      } else if (responseData['promotion_details'] != null) {
        onSuccess();
        return;
      }
    }

    if (selectedGateway.value?.name == "manual_payment" || walletSelect.value) {
      isLoading.value = false;
      context.toPage(ProcessStatusView(
          title: LocalKeys.requestSentSuccessfully,
          updateStatus: false,
          description: id != null ? "${LocalKeys.orderId}: #$id" : null,
          ebText: LocalKeys.backToHome,
          ebOnTap: (BuildContext context) {
            context.toUntilPage(const OnboardingView());
          },
          onWillPop: (BuildContext context) {
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
      orderId: sb.id,
      amount: sb.price,
      selectedGateway: selectedGateway.value!,
      userEmail: userEmail,
      userName: userName,
      userPhone: userPhone,
      userCity: userCity,
      userAddress: userAddress,
      paymentType: 'promotion',
    );
  }

  void setType(String s) {
    _type = s;
  }

  void setId(id) {
    _identity = id;
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

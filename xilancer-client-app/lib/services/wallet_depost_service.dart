import 'dart:io';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:provider/provider.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';

import '../customizations.dart';
import '../data/network/network_api_services.dart';
import '../view_models/wallet_deposit_view_model/wallet_deposit_view_model.dart';
import 'profile_info_service.dart';
import '../view_models/place_order_view_model/place_order_view_model.dart';

class WalletDepositService with ChangeNotifier {
  dynamic id;

  tryDeposit(File? manualImage) async {
    var url = AppUrls.walletDepositUrl;
    final wdm = WalletDepositViewModel.instance;
    final pom = PlaceOrderViewViewModel.instance;
    var request = http.MultipartRequest('POST', Uri.parse(url));
    request.fields.addAll({
      'amount': wdm.amountController.text,
      'selected_payment_gateway': wdm.selectedGateway.value!.name,
      if (wdm.selectedGateway.value?.name == "iyzipay") ...{
        'card_holder_name': pom.iyzicoCardNameController.text,
        'card_number': pom.iyzicoCardNumberController.text,
        'expire_month': pom.iyzicoExpireMonthController.text,
        'expire_year': pom.iyzicoExpireYearController.text,
        'cvc': pom.iyzicoCvcController.text,
        'card_token': pom.iyzicoSelectedCardToken.value ?? "",
        'card_user_key': pom.iyzicoCardUserKey.value ?? "",
        'register_card': pom.iyzicoSaveCard.value ? "1" : "0",
      }
    });
    if (manualImage != null) {
      request.files.add(await http.MultipartFile.fromPath(
          'manual_payment_image', manualImage.path));
    }
    request.headers.addAll(acceptJsonAuthHeader);
    final responseData =
        await NetworkApiServices().postWithFileApi(request, LocalKeys.deposit);

    if (responseData != null) {
      id = responseData["deposit_details"]?["id"];
      return responseData;
    }
  }

  updateDepositPayment(context) async {
    var url = AppUrls.updateDepositPaymentUrl;

    final pi = Provider.of<ProfileInfoService>(context, listen: false);
    var data = {
      "wallet_history_id": id.toString(),
      "status": "1",
      "secret_key": (pi.profileInfoModel.data?.email ?? "")
          .toHmac(secret: wPaymentUpdateEncryptionKey),
    };

    final responseData = await NetworkApiServices()
        .postApi(data, url, LocalKeys.payment, headers: acceptJsonAuthHeader);

    if (responseData != null) {
      LocalKeys.paymentSuccessful.showToast();
      return;
    }
  }
}

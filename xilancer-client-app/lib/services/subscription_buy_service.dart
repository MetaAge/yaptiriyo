import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:provider/provider.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/view_models/subscription_buy_view_model/subscription_buy_view_model.dart';

import '../customizations.dart';
import '../data/network/network_api_services.dart';
import '../helper/constant_helper.dart';
import 'profile_info_service.dart';
import '../view_models/place_order_view_model/place_order_view_model.dart';

class SubscriptionBuyService with ChangeNotifier {
  dynamic id;
  num price = 0;

  trySubscriptionBuy() async {
    var url = AppUrls.subsBuyUrl;
    final sbm = SubscriptionBuyViewModel.instance;
    final pom = PlaceOrderViewViewModel.instance;
    var request = http.MultipartRequest('POST', Uri.parse(url));
    request.fields.addAll({
      'subscription_id': sbm.id.toString(),
      'selected_payment_gateway': sbm.selectedGateway.value?.name ?? "wallet",
      if (sbm.selectedGateway.value?.name == "iyzipay") ...{
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
    if (sbm.selectedAttachment.value != null) {
      request.files.add(await http.MultipartFile.fromPath(
          'manual_payment_image', sbm.selectedAttachment.value!.path));
    }
    request.headers.addAll(acceptJsonAuthHeader);
    final responseData = await NetworkApiServices()
        .postWithFileApi(request, LocalKeys.buySubscription);

    if (responseData != null) {
      id = responseData["subscription_details"]?["id"];
      price = (responseData["subscription_details"]?["price"])
          .toString()
          .tryToParse;
      return responseData;
    }
  }

  updateDepositPayment(context) async {
    var url = AppUrls.updateSubsPaymentUrl;

    final pi = Provider.of<ProfileInfoService>(context, listen: false);
    var data = {
      "subscription_id": id.toString(),
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

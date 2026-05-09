import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

import '../customizations.dart';
import '../data/network/network_api_services.dart';
import '../helper/app_urls.dart';
import '../helper/constant_helper.dart';
import '../helper/local_keys.g.dart';
import '../view_models/promotion_payment_view_model/promotion_payment_view_model.dart';
import 'profile_info_service.dart';

class PromotionManageService with ChangeNotifier {
  dynamic id;
  num price = 0;

  tryPromoting() async {
    var url = AppUrls.promoteUrl;
    final ppm = PromotionPaymentViewModel.instance;
    var request = http.MultipartRequest('POST', Uri.parse(url));
    request.fields.addAll({
      'selected_payment_gateway': ppm.walletSelect.value
          ? "wallet"
          : ppm.selectedGateway.value?.name ?? "",
      'package_id': ppm.selectedPackage.value?.id?.toString() ?? "",
      'type': ppm.type.toString(),
      'identity': ppm.identity.toString(),
    });
    if (ppm.selectedAttachment.value != null) {
      request.files.add(await http.MultipartFile.fromPath(
          'manual_payment_image', ppm.selectedAttachment.value!.path));
    }
    request.headers.addAll(acceptJsonAuthHeader);
    final responseData = await NetworkApiServices()
        .postWithFileApi(request, LocalKeys.buySubscription);

    if (responseData != null) {
      id = responseData["promotion_details"]?["id"]?.toString();
      price =
          (responseData["promotion_details"]?["price"]).toString().tryToParse;
      return true;
    }
  }

  updatePromotePayment(context) async {
    var url = AppUrls.updatePromotionPaymentUrl;

    final pi = Provider.of<ProfileInfoService>(context, listen: false);
    var data = {
      "promotion_id": id.toString(),
      "status": "1",
      "secret_key": (pi.profileInfoModel.data?.email ?? "")
          .toHmac(secret: promotionPaymentUpdateEncryptionKey),
    };

    final responseData = await NetworkApiServices()
        .postApi(data, url, LocalKeys.payment, headers: acceptJsonAuthHeader);

    if (responseData != null) {
      LocalKeys.paymentSuccessful.showToast();
      return;
    }
  }
}

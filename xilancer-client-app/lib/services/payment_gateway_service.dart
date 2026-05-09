import 'package:flutter/material.dart';
import 'package:xilancer/data/network/network_api_services.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';

import '../helper/app_urls.dart';
import '../models/payment_gateway_model.dart';

class PaymentGatewayService with ChangeNotifier {
  List<Gateway> gatewayList = [];
  Gateway? selectedGateway;
  bool isLoading = false;
  DateTime? authPayED;
  bool doAgree = false;
  var transactionFeeType = "fixed";
  num transactionFee = 0;
  var projectOrderMilestoneAllowed = true;

  bool get shouldAutoFetch => gatewayList.isEmpty;

  setSelectedGareaway(value) {
    selectedGateway = value;
    notifyListeners();
  }

  setDoAgree(value) {
    doAgree = value;
    notifyListeners();
  }

  setAuthPayED(value) {
    if (value == authPayED) {
      return;
    }
    authPayED = value;
    notifyListeners();
  }

  bool itemSelected(value) {
    if (selectedGateway == null) {
      return false;
    }
    return selectedGateway == value;
  }

  setIsLoading(value) {
    isLoading = value;
    notifyListeners();
  }

  resetGateway() {
    selectedGateway = null;
    authPayED = null;
    doAgree = false;
    notifyListeners();
  }

  num getTransactionAmount(num amount) {
    debugPrint("amount is $amount".toString());
    debugPrint("amount is $transactionFee".toString());
    if (transactionFeeType != "percentage") {
      return transactionFee;
    }
    num feeAmount = 0;
    debugPrint("amount is $amount".toString());
    feeAmount = (transactionFee / 100) * amount;
    debugPrint("Fee amount is $feeAmount".toString());
    return feeAmount;
  }

  fetchGateways() async {
    if (gatewayList.isNotEmpty) {
      return;
    }

    try {
      var responseData = await NetworkApiServices().getApi(
          AppUrls.paymentGatewayUrl, LocalKeys.paymentGateway,
          headers: acceptJsonAuthHeader);
      if (responseData != null) {
        final modifiedResponse = [];
        for (var i = 0; i < responseData.length; i++) {
          try {
            Map gateway = responseData.values.toList()[i];
            gateway.putIfAbsent("name", () => responseData.keys.toList()[i]);
            if (gateway["name"] == "transaction_settings") continue;
            modifiedResponse.add(gateway);
          } catch (e) {}
        }
        final tempData =
            PaymentGatewayModel.fromJson({"data": modifiedResponse});
        gatewayList = tempData.data ?? [];
        projectOrderMilestoneAllowed =
            responseData["milestone_settings"] != "disable";
        debugPrint(responseData.keys.toList().reversed.toString());
        debugPrint(responseData.values.toList().reversed.toString());
        transactionFee = (responseData["transaction_settings"]
                ?["transaction_charge"])
            .toString()
            .tryToParse;
        transactionFeeType = (responseData["transaction_settings"]
                ?["transaction_type"] ??
            "fixed");
      }
      notifyListeners();
    } catch (err) {
      debugPrint(err.toString());
    }
  }
}

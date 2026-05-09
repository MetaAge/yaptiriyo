import 'package:flutter/material.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

import '../data/network/network_api_services.dart';

class ModuleListService with ChangeNotifier {
  var _hourlyJobModule = false;
  var _promotionModule = false;

  bool get hourlyJobModule => _hourlyJobModule;
  bool get promotionModule => _promotionModule;

  fetchModuleList() async {
    var url = AppUrls.moduleListUrl;

    final responseData = await NetworkApiServices().getApi(
      url,
      null,
      headers: acceptJsonAuthHeader,
    );

    if (responseData != null) {
      debugPrint(responseData.toString());
      _hourlyJobModule =
          (responseData["module_status"]?["HourlyJob"]).toString().parseToBool;
      _promotionModule = (responseData["module_status"]?["PromoteFreelancer"])
          .toString()
          .parseToBool;
      return true;
    }
  }
}

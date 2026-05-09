import 'package:flutter/material.dart';

import '../../data/network/network_api_services.dart';
import '../../helper/app_urls.dart';
import '../../helper/constant_helper.dart';
import '../../helper/local_keys.g.dart';
import '../models/promotion_packages_model.dart';

class PromotionPackagesService with ChangeNotifier {
  bool packagesLoading = false;
  String packagesSearchText = '';

  List<PromotionPackages?> packagesDropdownList = [];

  bool nextPageLoading = false;

  String? nextPage;

  bool nexLoadingFailed = false;

  setPackagesSearchValue(value) {
    if (value == packagesSearchText) {
      return;
    }
    packagesSearchText = value;
  }

  resetList() {
    if (packagesSearchText.isEmpty && packagesDropdownList.isNotEmpty) {
      return;
    }
    packagesSearchText = '';
    packagesDropdownList = [];
    getPackages();
  }

  void getPackages() async {
    packagesLoading = true;
    nextPage = null;
    notifyListeners();
    final url = "${AppUrls.promotionPackagesUrl}?packages=$packagesSearchText";
    final responseData = await NetworkApiServices().getApi(
        url, LocalKeys.packages,
        headers: commonAuthHeader, timeoutSeconds: 60);

    if (responseData != null) {
      final tempData = PromotionPackagesModel.fromJson(responseData);
      packagesDropdownList = tempData.packageLists?.data ?? [];
      nextPage = tempData.packageLists?.nextPageUrl;
      debugPrint(
          "Packages dropdown list lenght is ${packagesDropdownList.length}"
              .toString());
      notifyListeners();
    } else {}

    packagesLoading = false;
    notifyListeners();
  }

  fetchNextPage() async {
    if (nextPageLoading || nextPage == null) return;
    nextPageLoading = true;
    final responseData =
        await NetworkApiServices().getApi(nextPage!, "Packages fetching");

    if (responseData != null) {
      final tempData = PromotionPackagesModel.fromJson(responseData);
      tempData.packageLists?.data?.forEach((element) {
        packagesDropdownList.add(element);
      });

      nextPage = tempData.packageLists?.nextPageUrl;
    } else {
      nexLoadingFailed = true;
      Future.delayed(const Duration(seconds: 1)).then((value) {
        nexLoadingFailed = false;
        notifyListeners();
      });
    }
    nextPageLoading = false;
    notifyListeners();
  }
}

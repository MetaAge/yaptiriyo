import 'package:flutter/material.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';

import '../data/network/network_api_services.dart';
import '../models/my_projects_model.dart';

class MyProjectsService with ChangeNotifier {
  MyProjectsModel? _myProjectsModel;

  bool nextPageLoading = false;
  bool nexLoadingFailed = false;

  MyProjectsModel get mProjectsModel => _myProjectsModel ?? MyProjectsModel();

  String token = '';
  String? nextPage;

  bool get shouldAutoFetch => _myProjectsModel == null || token.isInvalid;

  fetchMyProjects() async {
    var url = AppUrls.myProjectsUrl;
    token = getToken;

    final responseData = await NetworkApiServices().getApi(
      url,
      LocalKeys.myProjects,
      headers: acceptJsonAuthHeader,
    );

    if (responseData != null) {
      _myProjectsModel = MyProjectsModel.fromJson(responseData);
      nextPage = mProjectsModel.projectLists?.nextPageUrl;
      nextPageLoading = false;
      notifyListeners();
      return true;
    }
  }

  fetchNextPage() async {
    if (_myProjectsModel?.projectLists?.nextPageUrl == null) {
      return;
    }
    nextPageLoading = true;
    notifyListeners();
    final responseData = await NetworkApiServices().getApi(
      nextPage!,
      LocalKeys.next,
      headers: acceptJsonAuthHeader,
    );

    if (responseData != null) {
      final tempData = MyProjectsModel.fromJson(responseData);
      tempData.projectLists?.data?.forEach((element) {
        _myProjectsModel?.projectLists?.data?.add(element);
      });
      nextPage = tempData.projectLists?.nextPageUrl;
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

  void removeProject(id) {
    try {
      _myProjectsModel?.projectLists?.data
          ?.removeWhere((element) => element.id.toString() == id.toString());
      notifyListeners();
    } catch (e) {}
  }

  toggleStatus(id, context) async {
    final index = _myProjectsModel?.projectLists?.data
        ?.indexWhere((element) => element.id.toString() == id.toString());
    if (index == null || index == -1) return;
    final project = _myProjectsModel!.projectLists!.data![index];
    final nextStatus = project.projectOnOff == 1 ? "0" : "1";
    final responseData = await NetworkApiServices().postApi({
      "project_id": id.toString(),
      "project_on_off": nextStatus,
    }, AppUrls.projectStatusChangeUrl, LocalKeys.myProjects,
        headers: acceptJsonAuthHeader);

    if (responseData != null) {
      project.projectOnOff = nextStatus.tryToParse;
      notifyListeners();
      responseData["msg"]?.toString().showToast();
      return true;
    }
  }

  deleteProject(id, context) async {
    final responseData = await NetworkApiServices().postApi(
        {"project_id": id.toString()},
        AppUrls.projectDeleteUrl,
        LocalKeys.myProjects,
        headers: acceptJsonAuthHeader);

    if (responseData != null) {
      removeProject(id);
      responseData["msg"]?.toString().showToast();
      return true;
    }
  }

  num projectAVGRating(id) {
    try {
      return _myProjectsModel?.projectLists?.data
              ?.firstWhere((element) => element.id.toString() == id.toString())
              .ratingsAvgRating ??
          0;
    } catch (e) {
      return 0;
    }
  }

  num projectRatingCount(id) {
    try {
      return _myProjectsModel?.projectLists?.data
              ?.firstWhere((element) => element.id.toString() == id.toString())
              .ratingsCount ??
          0;
    } catch (e) {
      return 0;
    }
  }

  num projectCompleteOrder(id) {
    try {
      return _myProjectsModel?.projectLists?.data
              ?.firstWhere((element) => element.id.toString() == id.toString())
              .completeOrdersCount ??
          0;
    } catch (e) {
      return 0;
    }
  }

  toggleSubscriptionPromotion(id, context) async {
    final index = _myProjectsModel?.projectLists?.data
        ?.indexWhere((element) => element.id.toString() == id.toString());
    if (index == null || index == -1) return;
    final project = _myProjectsModel!.projectLists!.data![index];

    final responseData = await NetworkApiServices().postApi({
      "project_id": id.toString(),
    }, AppUrls.projectSubscriptionPromoteToggleUrl, LocalKeys.myProjects,
        headers: acceptJsonAuthHeader);

    if (responseData != null) {
      project.isSubscriptionPromoted =
          responseData["is_subscription_promoted"].toString().parseToBool;
      notifyListeners();
      responseData["msg"]?.toString().showToast();
      return true;
    }
  }
}

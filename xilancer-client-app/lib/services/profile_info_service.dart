import 'package:flutter/material.dart';

import '../../data/network/network_api_services.dart';
import '../../helper/app_urls.dart';
import '../../helper/constant_helper.dart';
import '../../helper/local_keys.g.dart';
import '../../models/profile_info_model.dart';
import '../../services/user_mode_service.dart';

class ProfileInfoService with ChangeNotifier {
  ProfileInfoModel? _profileInfoModel;

  ProfileInfoModel get profileInfoModel =>
      _profileInfoModel ?? ProfileInfoModel();

  Future fetchProfileInfo() async {
    debugPrint(getToken.toString());
    debugPrint(commonAuthHeader.toString());
    final responseData = await NetworkApiServices().getApi(
        AppUrls.profileInfoUrl, LocalKeys.profileInfo,
        headers: acceptJsonAuthHeader, timeoutSeconds: 60);
    if (responseData != null) {
      debugPrint("Profile Info Response: ${responseData.toString()}");
      _profileInfoModel = ProfileInfoModel.fromJson(responseData);
      final ut = _profileInfoModel?.data?.userType.toString();
      if (ut == "2") {
        await UserModeService.instance.setMode(UserMode.freelancer);
      } else if (ut == "1") {
        await UserModeService.instance.setMode(UserMode.client);
      }
      notifyListeners();
      return true;
    } else {}
    notifyListeners();
  }

  void reset() {
    _profileInfoModel = null;
    notifyListeners();
  }
}

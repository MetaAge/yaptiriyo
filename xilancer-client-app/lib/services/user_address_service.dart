import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/models/user_address_model.dart';
import 'package:xilancer/data/network/network_api_services.dart';

class UserAddressService with ChangeNotifier {
  UserAddressModel? addressModel;
  bool isLoading = false;

  Future fetchAddresses() async {
    if (getToken.isEmpty) return;
    isLoading = true;
    notifyListeners();
    try {
      final responseData = await NetworkApiServices().getApi(AppUrls.userAddressesUrl, "fetchAddresses", headers: acceptJsonAuthHeader);
      if (responseData != null) {
        addressModel = UserAddressModel.fromJson(Map<String, dynamic>.from(responseData));
      }
    } catch (e) {
      debugPrint("Error fetching addresses: $e");
    } finally {
      isLoading = false;
      notifyListeners();
    }
  }

  Future addAddress(Map<String, dynamic> data) async {
    try {
      final responseData = await NetworkApiServices().postApi(data, AppUrls.userAddressStoreUrl, null, headers: acceptJsonAuthHeader);
      if (responseData != null) {
        await fetchAddresses();
        return true;
      }
    } catch (e) {
      debugPrint("Error adding address: $e");
    }
    return false;
  }

  Future updateAddress(int id, Map<String, dynamic> data) async {
    try {
      final url = "${AppUrls.userAddressUpdateUrl}/$id";
      final responseData = await NetworkApiServices().postApi(data, url, null, headers: acceptJsonAuthHeader);
      if (responseData != null) {
        await fetchAddresses();
        return true;
      }
    } catch (e) {
      debugPrint("Error updating address: $e");
    }
    return false;
  }

  Future deleteAddress(int id) async {
    try {
      final url = "${AppUrls.userAddressDeleteUrl}/$id";
      final responseData = await NetworkApiServices().postApi({}, url, null, headers: acceptJsonAuthHeader);
      if (responseData != null) {
        await fetchAddresses();
        return true;
      }
    } catch (e) {
      debugPrint("Error deleting address: $e");
    }
    return false;
  }

  Future makeDefault(int id) async {
    try {
      final url = "${AppUrls.userAddressMakeDefaultUrl}/$id";
      final responseData = await NetworkApiServices().postApi({}, url, null, headers: acceptJsonAuthHeader);
      if (responseData != null) {
        await fetchAddresses();
        return true;
      }
    } catch (e) {
      debugPrint("Error making address default: $e");
    }
    return false;
  }

  UserAddress? get defaultAddress {
    if (addressModel == null || addressModel!.addresses == null) return null;
    return addressModel!.addresses!.firstWhere((element) => element.isDefault == true, 
      orElse: () => addressModel!.addresses!.isEmpty ? UserAddress() : addressModel!.addresses!.first);
  }

  void reset() {
    addressModel = null;
    isLoading = false;
    notifyListeners();
  }
}

import 'dart:io';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../data/network/network_api_services.dart';
import '../helper/app_urls.dart';
import '../helper/constant_helper.dart';
import '../helper/local_keys.g.dart';
import '../models/profile_details_model.dart';

class PortfolioService with ChangeNotifier {
  List<Portfolio> portfolios = [];
  String? portfolioPath;
  bool isLoading = false;

  Future fetchPortfolios() async {
    isLoading = true;
    notifyListeners();
    try {
      final responseData = await NetworkApiServices().getApi(
        AppUrls.portfolioListUrl,
        LocalKeys.portfolio,
        headers: acceptJsonAuthHeader,
      );
      if (responseData != null) {
        portfolios = (responseData['portfolios'] as List)
            .map((e) => Portfolio.fromJson(e))
            .toList();
        portfolioPath = responseData['portfolio_path'];
      }
    } catch (e) {
      debugPrint(e.toString());
    }
    isLoading = false;
    notifyListeners();
  }

  Future<bool> storePortfolio({
    required String title,
    required String description,
    required File image,
  }) async {
    var request = http.MultipartRequest('POST', Uri.parse(AppUrls.portfolioStoreUrl));
    request.headers.addAll(commonAuthHeader);
    request.fields.addAll({
      'title': title,
      'description': description,
    });
    request.files.add(await http.MultipartFile.fromPath('image', image.path));

    final response = await NetworkApiServices().postWithFileApi(
      request,
      LocalKeys.portfolio,
    );

    if (response != null) {
      fetchPortfolios();
      return true;
    }
    return false;
  }

  Future<bool> updatePortfolio({
    required dynamic id,
    required String title,
    required String description,
    File? image,
  }) async {
    var request = http.MultipartRequest('POST', Uri.parse("${AppUrls.portfolioUpdateUrl}/$id"));
    request.headers.addAll(commonAuthHeader);
    request.fields.addAll({
      'title': title,
      'description': description,
    });
    if (image != null) {
      request.files.add(await http.MultipartFile.fromPath('image', image.path));
    }

    final response = await NetworkApiServices().postWithFileApi(
      request,
      LocalKeys.portfolio,
    );

    if (response != null) {
      fetchPortfolios();
      return true;
    }
    return false;
  }

  Future<bool> deletePortfolio(dynamic id) async {
    final response = await NetworkApiServices().postApi(
      {},
      "${AppUrls.portfolioDeleteUrl}/$id",
      LocalKeys.portfolio,
      headers: acceptJsonAuthHeader,
    );

    if (response != null) {
      portfolios.removeWhere((element) => element.id == id);
      notifyListeners();
      return true;
    }
    return false;
  }
}

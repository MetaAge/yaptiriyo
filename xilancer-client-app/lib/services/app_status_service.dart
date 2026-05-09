import 'dart:convert';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:package_info_plus/package_info_plus.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/models/app_status_model.dart';
import 'package:xilancer/views/common/maintenance_view.dart';
import 'package:xilancer/views/common/update_view.dart';
import 'package:xilancer/views/common/no_connection_view.dart';
import 'package:xilancer/main.dart';

class AppStatusService with ChangeNotifier {
  AppStatusModel? _status;
  AppStatusModel? get status => _status;

  Future<bool> checkAppStatus(BuildContext context) async {
    final urls = [
      "${AppUrls.baseUrl}/api/v1/app-status",
      "${AppUrls.baseUrl}/v1/app-status",
    ];

    for (var url in urls) {
      try {
        debugPrint("Checking app status at: $url");
        final response = await http.get(Uri.parse(url))
            .timeout(const Duration(seconds: 5));

        debugPrint("AppStatus ($url) Response Code: ${response.statusCode}");

        if (response.statusCode == 200) {
          debugPrint("AppStatus Response Body: ${response.body}");
          final data = jsonDecode(response.body);
          _status = AppStatusModel.fromJson(data);
          notifyListeners();

          if (_status!.maintenanceMode) {
            Navigator.pushAndRemoveUntil(
              context,
              MaterialPageRoute(builder: (_) => MaintenanceView(message: _status!.maintenanceMessage)),
              (route) => false,
            );
            return false;
          }

          final packageInfo = await PackageInfo.fromPlatform();
          final currentVersion = packageInfo.version;
          final serverVersion = Platform.isAndroid ? _status!.androidVersion : _status!.iosVersion;

          if (_isVersionLower(currentVersion, serverVersion) && _status!.forceUpdate) {
            Navigator.pushAndRemoveUntil(
              context,
              MaterialPageRoute(builder: (_) => UpdateView()),
              (route) => false,
            );
            return false;
          }

          return true;
        }
      } catch (e) {
        debugPrint("AppStatus attempt ($url) failed: $e");
      }
    }

    _showNoConnection(context);
    return false;
  }

  bool _isVersionLower(String current, String server) {
    List<int> currentParts = current.split('.').map(int.parse).toList();
    List<int> serverParts = server.split('.').map(int.parse).toList();

    for (int i = 0; i < serverParts.length; i++) {
      int c = i < currentParts.length ? currentParts[i] : 0;
      int s = serverParts[i];
      if (c < s) return true;
      if (c > s) return false;
    }
    return false;
  }

  void _showNoConnection(BuildContext context) {
    Navigator.pushAndRemoveUntil(
      context,
      MaterialPageRoute(builder: (_) => const NoConnectionView()),
      (route) => false,
    );
  }
}

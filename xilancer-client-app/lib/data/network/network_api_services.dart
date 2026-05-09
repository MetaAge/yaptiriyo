import 'dart:convert';
import 'dart:io';

import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

import '../../data/network/base_api_services.dart';
import '../../helper/extension/string_extension.dart';
import '../../helper/local_keys.g.dart';
import '../../helper/network_connectivity.dart';
import '../../main.dart';
import '../../views/common/no_connection_view.dart';
import '../app_exceptions.dart';

class NetworkApiServices extends BaseApiServices {
  final NetworkConnectivity networkConnectivity = NetworkConnectivity.instance;
  @override
  Future<Map?> getApi(
    String url,
    requestName, {
    headers,
    timeoutSeconds,
  }) async {
    if (kDebugMode) {
      debugPrint(url);
    }

    final hasConnection = await networkConnectivity.currentStatus();
    if (!hasConnection) {
      debugPrint("connection state is $hasConnection".toString());

      _handleNoConnection();
      return null;
    }
    Map<String, String> h = headers ?? {};
    h.addAll({'Accept': 'application/json'});
    Map? responseJson;
    try {
      final response = await http
          .get(Uri.parse(url), headers: h)
          .timeout(Duration(seconds: timeoutSeconds ?? 20));
      if (kDebugMode) {
        debugPrint(response.body.toString());
        debugPrint(response.statusCode.toString());
      }
      responseJson = returnResponse(response);
    } on SocketException {
      InternetException('');
      debugPrint("socket exception");
      _handleNoConnection();
    } on RequestTimeOut {
      debugPrint("request timeout");
      _handleNoConnection();
      RequestTimeOut('');
    } catch (e) {
      debugPrint(e.toString());
      showError(requestName, e.toString());
    }
    debugPrint(responseJson?.toString());
    return responseJson;
  }

  @override
  Future<Map?> postApi(
    var data,
    String url,
    requestName, {
    headers,
    timeoutSeconds,
  }) async {
    if (kDebugMode) {
      debugPrint(url);
      debugPrint(data.toString());
    }
    final hasConnection = await networkConnectivity.currentStatus();
    if (!hasConnection) {
      debugPrint("connection state is $hasConnection".toString());

      _handleNoConnection();
      return null;
    }
    Map<String, String> h = headers ?? {};
    h.putIfAbsent('Accept', () => 'application/json');
    Map? responseJson;
    try {
      final response = await http
          .post(Uri.parse(url), body: data, headers: h)
          .timeout(Duration(seconds: timeoutSeconds ?? 20));
      if (kDebugMode) {
        debugPrint(response.body.toString());
        debugPrint(response.statusCode.toString());
      }
      responseJson = returnResponse(response);
    } on SocketException {
      debugPrint("invalid url");
      _handleNoConnection();
    } on RequestTimeOut {
      debugPrint("request timeout");
      _handleNoConnection();
    } catch (e) {
      if (requestName == null) rethrow;
      showError(requestName, e.toString());
      debugPrint(e.toString());
    }
    return responseJson;
  }

  Future<Map?> postWithFileApi(
    http.MultipartRequest request,
    requestName, {
    headers,
    timeoutSeconds,
  }) async {
    if (kDebugMode) {
      debugPrint(request.url.toString());
      debugPrint(request.fields.toString());
    }
    final hasConnection = await networkConnectivity.currentStatus();
    if (!hasConnection) {
      debugPrint("connection state is $hasConnection".toString());

      _handleNoConnection();
      return null;
    }

    Map? responseJson;
    try {
      final responseStream = await request.send().timeout(
        Duration(seconds: timeoutSeconds ?? 20),
      );
      final data = await responseStream.stream.toBytes();
      http.Response response = http.Response.bytes(
        data,
        responseStream.statusCode,
      );
      if (kDebugMode) {
        debugPrint(response.body.toString());
        debugPrint(responseStream.statusCode.toString());
      }
      responseJson = returnResponse(response);
    } on SocketException {
      debugPrint("invalid url");
      _handleNoConnection();
    } on RequestTimeOut {
      debugPrint("request timeout");
      _handleNoConnection();
    } catch (e) {
      if (requestName == null) rethrow;
      showError(requestName, e.toString());
      debugPrint(e.toString());
    }
    return responseJson;
  }

  _handleNoConnection() {
    navigatorKey.currentState?.pushAndRemoveUntil(
      MaterialPageRoute(builder: (context) => const NoConnectionView()),
      (route) => false,
    );
  }

  dynamic returnResponse(http.Response response) {
    switch (response.statusCode) {
      case 200:
        try {
          dynamic responseJson = jsonDecode(response.body);

          return responseJson;
        } catch (_) {
          return {};
        }
      case 201:
        try {
          dynamic responseJson = jsonDecode(response.body);

          return responseJson;
        } catch (_) {
          return {};
        }

      case 400:
        try {
          dynamic responseJson = jsonDecode(response.body);
          if (responseJson["message"] != null) {
            responseJson["message"].toString().showToast();
            return null;
          }
        } catch (_) {
          debugPrint(response.body.toString());
          throw FetchDataException('${response.reasonPhrase}');
        }
      case 422:
        try {
          checkAuthentication(response);
          dynamic responseJson = jsonDecode(response.body);

          showValidationErrors(responseJson);
        } catch (error) {
          if (error is String) {
            rethrow;
          }
          debugPrint(response.body.toString());
          throw FetchDataException('${response.reasonPhrase}');
        }
      case 401:
        try {
          checkAuthentication(response);
          dynamic responseJson = jsonDecode(response.body);
          showValidationErrors(responseJson);
        } catch (e) {
          if (e is String) {
            rethrow;
          }
          debugPrint(response.body.toString());
          throw FetchDataException('${response.reasonPhrase}');
        }

      default:
        try {
          checkAuthentication(response);
          dynamic responseJson = jsonDecode(response.body);

          showValidationErrors(responseJson);
        } catch (e) {
          if (e is String) {
            rethrow;
          }
          debugPrint(response.body.toString());
          throw FetchDataException('${response.reasonPhrase}');
        }
    }
  }

  checkAuthentication(http.Response response) {
    if (response.body.contains("Unauthenticated.")) {
      // debugPrint(navigatorKey.currentState?.toString());

      // SignInViewModel.instance.initSavedInfo();
      // navigatorKey.currentState?.pushAndRemoveUntil(
      //     MaterialPageRoute(
      //       builder: (context) => const SignInView(),
      //     ),
      //     (route) => false);
      // LocalKeys.sessionExpired.showToast();
      return null;
    }
  }

  showError(requestName, error) {
    if (requestName != null) {
      "$requestName: $error".showToast();
    }
  }

  showValidationErrors(Map json) {
    debugPrint("in validation error method".toString());
    if (!json.containsKey("errors") || json["errors"] == {}) {
      debugPrint((json["msg"] ?? json["message"]).toString());
      throw json["msg"] ?? json["message"] ?? "Error occurred";
    }

    final errors = json["errors"];
    debugPrint(errors.toString());
    if (errors.isEmpty) {
      debugPrint("throwing error".toString());
      throw json["msg"] ?? json["message"] ?? json;
    }
    if (errors is Map) {
      final keys = errors.keys.toList();
      keys.remove("status");
      debugPrint(keys.last.toString());
      final passwordError = errors[keys.first];
      debugPrint(passwordError.toString());
      if (passwordError is String) {
        throw passwordError;
      } else if (passwordError is List && passwordError.isNotEmpty) {
        throw passwordError.first;
      }
    }
  }
}

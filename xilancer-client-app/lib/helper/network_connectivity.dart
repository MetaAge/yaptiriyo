import 'dart:async';
import 'dart:io';

import 'package:connectivity_plus/connectivity_plus.dart';
import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/main.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/views/common/no_connection_view.dart';

class NetworkConnectivity {
  NetworkConnectivity._();
  static final _instance = NetworkConnectivity._();
  static NetworkConnectivity get instance => _instance;
  final _networkConnectivity = Connectivity();
  final _controller = StreamController.broadcast();
  Stream get myStream => _controller.stream;
  void initialise() async {
    List<ConnectivityResult> result =
        await _networkConnectivity.checkConnectivity();
    if (result.isEmpty) {
      return;
    }
    _checkStatus(result.last);
    _networkConnectivity.onConnectivityChanged.listen((result) {
      print(result);
      _checkStatus(result.last);
    });
  }

  Future<bool> currentStatus() async {
    bool isOnline = false;
    try {
      final result = await InternetAddress.lookup('google.com');
      isOnline = result.isNotEmpty && result[0].rawAddress.isNotEmpty;
    } on SocketException catch (_) {
      isOnline = false;
    }
    return isOnline;
  }

  void _checkStatus(ConnectivityResult result) async {
    bool isOnline = false;
    try {
      final result = await InternetAddress.lookup('google.com');
      isOnline = result.isNotEmpty && result[0].rawAddress.isNotEmpty;
    } on SocketException catch (_) {
      isOnline = false;
    }
    _controller.sink.add({result: isOnline});
  }

  void disposeStream() => _controller.close();

  listenToConnectionChange(BuildContext context) {
    Map source = {ConnectivityResult.none: false};
    String string = '';
    initialise();
    bool isOffline = false;
    myStream.listen((source) {
      source = source;
      print('source $source');

      switch (source.keys.toList()[0]) {
        case ConnectivityResult.mobile:
          string =
              source.values.toList()[0] ? 'Mobile: Online' : 'Mobile: Offline';
          break;
        case ConnectivityResult.wifi:
          string = source.values.toList()[0] ? 'WiFi: Online' : 'WiFi: Offline';
          break;
        case ConnectivityResult.none:
        default:
          string = 'Offline';
      }
      if (string.contains('Online') && isOffline) {
        isOffline = false;
        Navigator.pop(context);
      }
      if (string.contains('Offline') && !isOffline) {
        isOffline = true;
        navigatorKey.currentState?.pushAndRemoveUntil(
          MaterialPageRoute(builder: (context) => const NoConnectionView()),
          (route) => false,
        );
      }
    });
  }
}

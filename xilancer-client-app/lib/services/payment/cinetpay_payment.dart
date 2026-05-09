import 'dart:async';
import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:webview_flutter/webview_flutter.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/utils/components/empty_widget.dart';

import '../../utils/components/alerts.dart';
import '../../utils/components/custom_preloader.dart';
import '../../utils/components/navigation_pop_icon.dart';

class CinetPayPayment extends StatelessWidget {
  final testing;
  final String apiKey;
  final siteId;
  final id;
  final amount;
  final currencyCode;
  final userName;
  final userPhone;
  final userMail;
  final userAddress;
  final userCountryCode;
  final userStateCode;
  final userZipCode;
  final userCity;
  final onSuccess;
  final onFailed;

  CinetPayPayment(
      {super.key,
      required this.testing,
      required this.apiKey,
      required this.siteId,
      required this.id,
      required this.amount,
      required this.currencyCode,
      this.userName,
      this.userPhone,
      required this.userMail,
      this.userAddress,
      this.userCountryCode,
      this.userStateCode,
      this.userZipCode,
      this.onSuccess,
      this.onFailed,
      required this.userCity});
  String? url;
  String? errorDescription;
  final WebViewController _controller = WebViewController();
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: NavigationPopIcon(onTap: () async {
          Alerts().paymentFailWarning(context, onFailed: onFailed);
        }),
      ),
      body: WillPopScope(
        onWillPop: () async {
          bool canGoBack = await _controller.canGoBack();
          if (canGoBack) {
            _controller.goBack();
            return false;
          }
          Alerts().paymentFailWarning(context, onFailed: onFailed);
          return false;
        },
        child: FutureBuilder(
            future: waitForIt(
              context,
              testing,
              apiKey,
              siteId,
              id,
              amount,
              currencyCode,
              userName,
              userMail,
              userPhone,
              userAddress,
              userCountryCode,
              userStateCode,
              userZipCode,
              userCity,
            ),
            builder: (context, snapshot) {
              if (snapshot.connectionState == ConnectionState.waiting) {
                return const Column(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Center(
                        child: SizedBox(height: 60, child: CustomPreloader())),
                  ],
                );
              }
              if (snapshot.hasData) {
                return EmptyWidget(title: errorDescription ?? "");
                // return errorWidget();
              }
              if (snapshot.hasError) {
                print(snapshot.error);
                // return errorWidget();
              }
              _controller
                ..loadRequest(Uri.parse(url ?? ''))
                ..setJavaScriptMode(JavaScriptMode.unrestricted)
                ..setNavigationDelegate(
                  NavigationDelegate(
                    onProgress: (int progress) {
                      // Update loading bar.
                    },
                    onPageStarted: (String url) {},
                    onPageFinished: (String url) {
                      // verifyPayment(url.toString());
                    },
                    onWebResourceError: (WebResourceError error) {},
                    onNavigationRequest: (NavigationRequest request) {
                      if (request.url.startsWith('https://www.youtube.com')) {
                        onSuccess();
                        return NavigationDecision.prevent;
                      }
                      return NavigationDecision.navigate;
                    },
                  ),
                );
              return WebViewWidget(
                controller: _controller,
              );
            }),
      ),
    );
  }

  waitForIt(
    BuildContext context,
    testing,
    apiKey,
    siteId,
    id,
    amount,
    currencyCode,
    userName,
    userMail,
    userPhone,
    userAddress,
    userCountryCode,
    userStateCode,
    userZipCode,
    userCity,
  ) async {
    final url = Uri.parse('https://api-checkout.cinetpay.com/v2/payment');
    final header = {
      "Content-Type": "application/json",
      "Accept": "application/json",
    };
    debugPrint(apiKey.toString());
    debugPrint("apiKey".toString());
    debugPrint("apiKey________".toString());
    debugPrint("apiKey________--------".toString());
    debugPrint("apiKey________--------________".toString());
    debugPrint("apiKey________--------________------".toString());

    final response = await http.post(url,
        headers: header,
        body: jsonEncode({
          "apikey": apiKey,
          "site_id": siteId,
          "transaction_id": id,
          "amount": amount.round(),
          "currency": currencyCode,
          "alternative_currency": "USD",
          "description": '$appLabel Products',
          "customer_id": id ?? '123',
          "customer_name": userName ?? "",
          "customer_surname": userName ?? "",
          "customer_email": userMail ?? '',
          "customer_phone_number": userPhone ?? '',
          "customer_address": userAddress ?? '',
          "customer_city": userCity ?? "",
          "customer_country": userCountryCode ?? "CM",
          "customer_state": userStateCode ?? "CM",
          "customer_zip_code": userZipCode,
          "return_url": "https://www.youtube.com",
          "channels": "ALL"
        }));
    print(response.body);
    if (response.statusCode >= 200 && response.statusCode < 300) {
      this.url = jsonDecode(response.body)['data']['payment_url'];
      debugPrint(this.url.toString());
      return;
    } else {
      errorDescription = jsonDecode(response.body)['description'];
      return false;
    }
  }

  Future<bool> verifyPayment(String url) async {
    final uri = Uri.parse(url);
    final response = await http.get(uri);
    return response.body.contains('successful');
  }
}

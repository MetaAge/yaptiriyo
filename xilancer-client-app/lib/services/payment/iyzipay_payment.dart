import 'dart:convert';
import 'package:flutter/material.dart';
import 'package:webview_flutter/webview_flutter.dart';
import 'package:xilancer/data/network/network_api_services.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/helper/constant_helper.dart';

import '../../utils/components/alerts.dart';
import '../../utils/components/custom_preloader.dart';
import '../../utils/components/navigation_pop_icon.dart';

class IyzipayPayment extends StatefulWidget {
  final VoidCallback onSuccess;
  final Function(String?) onFailed;
  final String htmlContent;
  final String orderId;
  final String? paymentType;

  const IyzipayPayment({
    Key? key,
    required this.onSuccess,
    required this.onFailed,
    required this.htmlContent,
    required this.orderId,
    this.paymentType,
  }) : super(key: key);

  @override
  State<IyzipayPayment> createState() => _IyzipayPaymentState();
}

class _IyzipayPaymentState extends State<IyzipayPayment> {
  final WebViewController _controller = WebViewController();
  int _loadingProgress = 0;
  bool _isProcessingCallback = false;

  @override
  void initState() {
    super.initState();
    _controller
      ..setJavaScriptMode(JavaScriptMode.unrestricted)
      ..setBackgroundColor(const Color(0xFFFFFFFF))
      ..setNavigationDelegate(NavigationDelegate(
        onProgress: (int progress) {
          if (mounted) {
            setState(() {
              _loadingProgress = progress;
            });
          }
        },
        onNavigationRequest: (NavigationRequest request) {
          debugPrint('Navigation requested to: ${request.url}');
          
          if (request.url.contains('iyzico/3ds-callback-web/result')) {
             _handleCallback(request.url);
            return NavigationDecision.prevent;
          }
          return NavigationDecision.navigate;
        },
        onPageFinished: (String url) {
          if (mounted) {
            setState(() {
              _loadingProgress = 100;
            });
          }
          if (url.contains('iyzico/3ds-callback-web/result')) {
             _handleCallback(url);
          }
        },
      ));

    // Convert HTML string to data URI
    final Uri contentUri = Uri.dataFromString(
      widget.htmlContent,
      mimeType: 'text/html',
      encoding: Encoding.getByName('utf-8'),
    );
    _controller.loadRequest(contentUri);
  }

  Future<void> _handleCallback(String urlStr) async {
    if (_isProcessingCallback) return;
    
    setState(() {
      _isProcessingCallback = true;
    });

    try {
      final uri = Uri.parse(urlStr);
      final paymentId = uri.queryParameters['paymentId'];
      final registerCard = uri.queryParameters['register_card'];

      if (paymentId == null) {
        throw Exception("Missing paymentId from callback");
      }

      final response = await NetworkApiServices().postApi(
        {
          'payment_id': paymentId,
          'order_id': widget.orderId,
          if (registerCard != null) 'register_card': registerCard,
          if (widget.paymentType != null) 'type': widget.paymentType,
        },
        AppUrls.iyzico3dsCompleteUrl,
        null, // Pass null to handle error locally
        headers: acceptJsonAuthHeader,
      );

      if (response != null && response['status'] == 'success') {
        Navigator.pop(context);
        widget.onSuccess();
      } else {
        Navigator.pop(context);
        String? errorMsg = response != null ? (response['msg'] ?? response['message']) : null;
        widget.onFailed(errorMsg ?? 'Payment failed');
      }
    } catch (e) {
      debugPrint("Error handling 3DS callback: $e");
      if (mounted) Navigator.pop(context);
      widget.onFailed(e.toString().replaceAll("Exception:", "").trim());
    }
  }

  @override
  Widget build(BuildContext context) {
    void handleCancel() {
      Alerts().paymentFailWarning(context, onFailed: () {
        Navigator.pop(context); // close the alert dialog
        Navigator.pop(context); // close IyzipayPayment
        widget.onFailed("Ödeme işlemi kullanıcı tarafından iptal edildi."); 
      });
    }

    return Scaffold(
      appBar: AppBar(
        title: Text(LocalKeys.payment),
        leading: NavigationPopIcon(onTap: () async {
          handleCancel();
        }),
      ),
      body: WillPopScope(
        onWillPop: () async {
          handleCancel();
          return false;
        },
        child: Stack(
          children: [
            if (!_isProcessingCallback)
              SizedBox.expand(child: WebViewWidget(controller: _controller)),
            if (_loadingProgress < 100 || _isProcessingCallback)
              const Center(child: SizedBox(height: 60, child: CustomPreloader())),
          ],
        ),
      ),
    );
  }
}

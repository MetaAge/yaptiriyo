import 'dart:async';
import 'dart:io';
import 'package:flutter/material.dart';
import 'package:in_app_purchase/in_app_purchase.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/subscription_buy_service.dart';
import '../data/network/network_api_services.dart';

class IAPService with ChangeNotifier {
  final InAppPurchase _inAppPurchase = InAppPurchase.instance;
  late StreamSubscription<List<PurchaseDetails>> _subscription;
  List<ProductDetails> products = [];
  bool isAvailable = false;
  bool isLoading = true;

  IAPService() {
    final Stream<List<PurchaseDetails>> purchaseUpdated =
        _inAppPurchase.purchaseStream;
    _subscription = purchaseUpdated.listen((purchaseDetailsList) {
      _listenToPurchaseUpdated(purchaseDetailsList);
    }, onDone: () {
      _subscription.cancel();
    }, onError: (error) {
      debugPrint("IAP Error: $error");
    });
  }

  Future<void> initStoreInfo(List<String> productIds) async {
    isLoading = true;
    notifyListeners();

    isAvailable = await _inAppPurchase.isAvailable();
    if (!isAvailable) {
      isLoading = false;
      notifyListeners();
      return;
    }

    ProductDetailsResponse productDetailResponse =
        await _inAppPurchase.queryProductDetails(productIds.toSet());
    if (productDetailResponse.error != null) {
      debugPrint("Query Error: ${productDetailResponse.error}");
      isAvailable = false;
    } else {
      products = productDetailResponse.productDetails;
    }

    isLoading = false;
    notifyListeners();
  }

  Future<void> buySubscription(ProductDetails productDetails) async {
    final PurchaseParam purchaseParam =
        PurchaseParam(productDetails: productDetails);
    
    if (Platform.isIOS) {
      await _inAppPurchase.buyNonConsumable(purchaseParam: purchaseParam);
    } else {
      await _inAppPurchase.buyNonConsumable(purchaseParam: purchaseParam);
    }
  }

  Future<void> restorePurchases() async {
    await _inAppPurchase.restorePurchases();
  }

  void _listenToPurchaseUpdated(List<PurchaseDetails> purchaseDetailsList) {
    purchaseDetailsList.forEach((PurchaseDetails purchaseDetails) async {
      if (purchaseDetails.status == PurchaseStatus.pending) {
        // Show loading
      } else {
        if (purchaseDetails.status == PurchaseStatus.error) {
          debugPrint("Purchase Error: ${purchaseDetails.error}");
          LocalKeys.paymentFailed.showToast();
        } else if (purchaseDetails.status == PurchaseStatus.purchased ||
            purchaseDetails.status == PurchaseStatus.restored) {
          
          bool valid = await _verifyPurchase(purchaseDetails);
          if (valid) {
            LocalKeys.paymentSuccessful.showToast();
          } else {
            LocalKeys.paymentFailed.showToast();
          }
        }
        if (purchaseDetails.pendingCompletePurchase) {
          await _inAppPurchase.completePurchase(purchaseDetails);
        }
      }
    });
  }

  Future<bool> _verifyPurchase(PurchaseDetails purchaseDetails) async {
    // Send receipt to backend for validation
    // We need to map the productID back to our internal subscription_id
    // This mapping can be done here if we have the list, or the backend can do it.
    // Since we added apple_product_id/google_product_id to the DB, the backend can handle it.
    
    // We need to find the internal subscription ID from the product ID.
    // For simplicity, we'll pass the product ID and the backend will find it.
    
    var data = {
      "product_id": purchaseDetails.productID,
      "receipt_data": purchaseDetails.verificationData.serverVerificationData,
      "store": Platform.isIOS ? "apple" : "google",
      "transaction_id": purchaseDetails.purchaseID,
    };

    final responseData = await NetworkApiServices().postApi(
        data, AppUrls.subsValidateIapUrl, LocalKeys.buySubscription,
        headers: acceptJsonAuthHeader);

    return responseData != null && responseData["status"] == "success";
  }

  @override
  void dispose() {
    _subscription.cancel();
    super.dispose();
  }
}

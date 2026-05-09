import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

import '../data/network/network_api_services.dart';
import '../helper/app_urls.dart';
import '../helper/local_keys.g.dart';
import '../models/order_details_model.dart';

class OrderDetailsService with ChangeNotifier {
  OrderDetailsModel? _orderDetailsModel;

  OrderDetailsModel get orderDetailsModel =>
      _orderDetailsModel ?? OrderDetailsModel();

  String token = "";

  bool shouldAutoFetch(id) =>
      _orderDetailsModel?.orderDetails?.id.toString() != id.toString() ||
      token.isInvalid;

  fetchOrderDetails({required orderId}) async {
    token = getToken;
    _orderDetailsModel = null;
    token = getToken;
    final url = "${AppUrls.orderDetailsUrl}/${orderId.toString()}";
    final responseData = await NetworkApiServices()
        .getApi(url, LocalKeys.orderDetails, headers: commonAuthHeader);

    if (responseData != null) {
      _orderDetailsModel = OrderDetailsModel.fromJson(responseData);
    } else {}
    notifyListeners();
  }

  tryAcceptingWork({
    required orderId,
    milestoneId,
  }) async {
    var url = AppUrls.acceptOrderUrl;
    var data = {
      'order_id': orderId?.toString() ?? "",
      'order_milestone_id': milestoneId?.toString() ?? "",
    };

    final responseData = await NetworkApiServices().postApi(
        data, url, LocalKeys.acceptOrder,
        headers: acceptJsonAuthHeader);

    if (responseData != null) {
      orderDetailsModel.orderDetails?.orderSubmitHistory?.lastOrNull?.status =
          1;
      try {
        orderDetailsModel.orderMileStones
            ?.firstWhere(
                (element) => element.id.toString() == milestoneId.toString())
            .status = 2;
      } catch (e) {}
      notifyListeners();
      return true;
    }
  }

  tryRequestingRevision(
      {orderId, orderWorkId, description, milestoneId}) async {
    var url = AppUrls.requestRevisionUrl;
    var data = {
      'order_id': '$orderId',
      'order_milestone_id': milestoneId?.toString() ?? "",
      'order_submit_history_id': '$orderWorkId',
      'revision_description': '$description'
    };

    final responseData = await NetworkApiServices().postApi(
        data, url, LocalKeys.acceptOrder,
        headers: acceptJsonAuthHeader);

    if (responseData != null) {
      orderDetailsModel.orderDetails?.orderSubmitHistory?.lastOrNull?.status =
          2;
      try {
        orderDetailsModel.orderMileStones
            ?.firstWhere(
                (element) => element.id.toString() == milestoneId.toString())
            .status = 1;
      } catch (e) {}
      LocalKeys.revisionRequestedSuccessfully.showToast();
      notifyListeners();
      return true;
    }
  }

  acceptOrder({required orderId}) async {
    var url = AppUrls.orderAcceptUrl;
    var data = {
      'order_id': orderId.toString(),
    };

    final responseData = await NetworkApiServices().postApi(
        data, url, LocalKeys.acceptOrder,
        headers: acceptJsonAuthHeader);

    if (responseData != null) {
      _orderDetailsModel?.orderDetails?.status = 1; // Active
      notifyListeners();
      return true;
    }
  }

  declineOrder({required orderId}) async {
    var url = AppUrls.orderCancelUrl;
    var data = {
      'order_id': orderId.toString(),
      'cancel_or_decline_order': 'decline',
    };

    final responseData = await NetworkApiServices().postApi(
        data, url, LocalKeys.declineOrder,
        headers: acceptJsonAuthHeader);

    if (responseData != null) {
      _orderDetailsModel?.orderDetails?.status = 4; // Cancelled/Declined
      notifyListeners();
      return true;
    }
  }

  submitWork({required orderId, milestoneId, description, attachment}) async {
    var url = AppUrls.submitWorkUrl;
    var request = http.MultipartRequest('POST', Uri.parse(url));
    request.headers.addAll(commonAuthHeader);
    request.fields['order_id'] = orderId.toString();
    request.fields['order_milestone_id'] = milestoneId?.toString() ?? "";
    request.fields['description'] = description;

    if (attachment != null) {
      request.files.add(await http.MultipartFile.fromPath(
        'attachment',
        attachment.path,
      ));
    }

    final responseData = await NetworkApiServices().postWithFileApi(
        request, LocalKeys.submitWork);

    if (responseData != null) {
      notifyListeners();
      return true;
    }
  }

  submitRating({required orderId, required rating, required feedback}) async {
    var url = AppUrls.submitRatingUrl;
    var data = {
      'order_id': orderId.toString(),
      'rating': rating.toString(),
      'review_feedback': feedback.toString(),
    };

    final responseData = await NetworkApiServices().postApi(
        data, url, LocalKeys.reviews,
        headers: acceptJsonAuthHeader);

    if (responseData != null) {
      final newRating = Rating(
        orderId: orderId,
        rating: rating,
        senderType: 1,
      );
      _orderDetailsModel?.orderDetails?.rating?.add(newRating);
      notifyListeners();
      return true;
    }
  }
}

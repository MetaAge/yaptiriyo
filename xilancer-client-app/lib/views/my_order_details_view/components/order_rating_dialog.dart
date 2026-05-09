import 'package:flutter/material.dart';
import 'package:flutter_rating_bar/flutter_rating_bar.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/view_models/my_order_details_view_model/my_order_details_view_model.dart';

import '../../../utils/components/custom_button.dart';

class OrderRatingDialog extends StatefulWidget {
  final dynamic orderId;
  const OrderRatingDialog({super.key, required this.orderId});

  @override
  State<OrderRatingDialog> createState() => _OrderRatingDialogState();
}

class _OrderRatingDialogState extends State<OrderRatingDialog> {
  double rating = 5.0;
  final TextEditingController feedbackController = TextEditingController();

  @override
  Widget build(BuildContext context) {
    final modm = MyOrderDetailsViewModel.instance;
    return Container(
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: const BorderRadius.vertical(top: Radius.circular(20)),
      ),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Text(
            LocalKeys.reviews,
            style: context.titleMedium?.copyWith(fontWeight: FontWeight.bold),
          ),
          16.toHeight,
          Center(
            child: RatingBar.builder(
              initialRating: 5,
              minRating: 1,
              direction: Axis.horizontal,
              allowHalfRating: true,
              itemCount: 5,
              itemPadding: const EdgeInsets.symmetric(horizontal: 4.0),
              itemBuilder: (context, _) => Icon(
                Icons.star,
                color: context.dProvider.warningColor,
              ),
              onRatingUpdate: (v) {
                rating = v;
              },
            ),
          ),
          16.toHeight,
          TextField(
            controller: feedbackController,
            maxLines: 4,
            decoration: InputDecoration(
              hintText: LocalKeys.writeMessage,
              border: OutlineInputBorder(
                borderRadius: BorderRadius.circular(8),
              ),
            ),
          ),
          24.toHeight,
          ValueListenableBuilder(
            valueListenable: modm.isLoading,
            builder: (context, loading, child) {
              return CustomButton(
                onPressed: () {
                  if (feedbackController.text.trim().isEmpty) {
                    LocalKeys.enterDescription.showToast();
                    return;
                  }
                  modm.trySubmitRating(
                    context,
                    orderId: widget.orderId,
                    rating: rating,
                    feedback: feedbackController.text.trim(),
                  );
                },
                btText: LocalKeys.submit,
                isLoading: loading,
              );
            },
          ),
          12.toHeight,
        ],
      ),
    );
  }
}

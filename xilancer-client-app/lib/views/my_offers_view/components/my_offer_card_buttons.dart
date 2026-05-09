import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/user_mode_service.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/services/my_offers_service.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

import '../../../view_models/place_order_view_model/place_order_view_model.dart';
import '../../offer_details_view/offer_details_view.dart';
import '../../place_order_view/place_order_view.dart';

class MyOfferCardButton extends StatelessWidget {
  final bool fromDetails;
  final offerId;
  final offerStatus;
  const MyOfferCardButton({
    super.key,
    required this.offerId,
    required this.fromDetails,
    required this.offerStatus,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        if (!fromDetails)
          SizedBox(
            width: double.infinity,
            child: OutlinedButton(
              onPressed: () {
                context.toPage(OfferDetailsView(id: offerId));
              },
              child: Text(LocalKeys.viewDetails),
            ),
          ),
        if (offerStatus.toString() == "0" && UserModeService.instance.isClient) ...[
          8.toHeight,
          CustomButton(
            onPressed: () {
              PlaceOrderViewViewModel.dispose;
              context.toPage(PlaceOrderView(
                offerId: offerId,
              ));
            },
            btText: LocalKeys.acceptOffer,
            isLoading: false,
          ),
          8.toHeight,
          SizedBox(
            width: double.infinity,
            child: OutlinedButton(
              style: OutlinedButton.styleFrom(
                foregroundColor: Colors.orange,
                side: const BorderSide(color: Colors.orange),
              ),
              onPressed: () {
                showDialog(
                  context: context,
                  builder: (context) => AlertDialog(
                    title: Text(LocalKeys.reject),
                    content: Text(LocalKeys.rejectOfferWarning),
                    actions: [
                      TextButton(onPressed: () => Navigator.pop(context), child: Text(LocalKeys.cancel)),
                      TextButton(
                        onPressed: () async {
                          Navigator.pop(context);
                          final mo = Provider.of<MyOffersService>(context, listen: false);
                          final success = await mo.rejectOffer(offerId);
                          if (success) {
                            LocalKeys.proposalRejectedSuccessfully.showToast();
                          }
                        },
                        child: Text(LocalKeys.reject, style: const TextStyle(color: Colors.orange)),
                      ),
                    ],
                  ),
                );
              },
              child: Text(LocalKeys.reject),
            ),
          ),
        ]
      ],
    );
  }
}

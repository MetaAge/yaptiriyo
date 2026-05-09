import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/image_assets.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/view_models/subscription_buy_view_model/subscription_buy_view_model.dart';
import 'package:xilancer/views/chat_list_view/components/chat_tile_avatar.dart';
import 'package:xilancer/views/subscription_buy_view/subscription_buy_view.dart';

import '../../../models/subscription_list_model.dart';
import 'package:xilancer/services/subscription_history_service.dart';
// import 'package:xilancer/views/payment_chose_view/payment_chose_view.dart';
import 'package:xilancer/services/iap_service.dart';
import 'package:xilancer/utils/components/terms_consent_dialog.dart';
import 'package:in_app_purchase/in_app_purchase.dart';
import 'dart:io';

class SubscriptionCard extends StatelessWidget {
  final Subscription subscription;
  const SubscriptionCard(
      {super.key,
      required this.subscription});

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Container(
      margin: const EdgeInsets.only(bottom: 16),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: BorderRadius.circular(20),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(isDark ? 0.2 : 0.05),
            blurRadius: 15,
            offset: const Offset(0, 8),
          ),
        ],
      ),
      child: Column(
        children: [
          // Header with Gradient
          Container(
            padding: const EdgeInsets.all(24),
            decoration: BoxDecoration(
              gradient: LinearGradient(
                colors: [
                  context.dProvider.primaryColor,
                  context.dProvider.primaryColor.withOpacity(0.8),
                ],
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
              ),
              borderRadius: const BorderRadius.only(
                topLeft: Radius.circular(20),
                topRight: Radius.circular(20),
              ),
            ),
            child: Row(
              children: [
                Container(
                  padding: const EdgeInsets.all(8),
                  decoration: BoxDecoration(
                    color: Colors.white.withOpacity(0.2),
                    shape: BoxShape.circle,
                  ),
                  child: const Icon(Icons.stars_rounded, color: Colors.white, size: 24),
                ),
                16.toWidth,
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        subscription.title ?? "",
                        style: context.titleLarge?.copyWith(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      Text(
                        "${subscription.limit} Teklif Hakkı",
                        style: context.bodySmall?.copyWith(
                          color: Colors.white.withOpacity(0.9),
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
          
          // Features List
          Padding(
            padding: const EdgeInsets.fromLTRB(24, 20, 24, 8),
            child: Column(
              children: subscription.features!.map((e) => Padding(
                padding: const EdgeInsets.only(bottom: 12),
                child: Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.all(2),
                      decoration: BoxDecoration(
                        color: e.status 
                            ? context.dProvider.greenColor.withOpacity(0.1)
                            : context.dProvider.warningColor.withOpacity(0.1),
                        shape: BoxShape.circle,
                      ),
                      child: Icon(
                        e.status ? Icons.check_rounded : Icons.close_rounded,
                        color: e.status
                            ? context.dProvider.greenColor
                            : context.dProvider.warningColor,
                        size: 16,
                      ),
                    ),
                    12.toWidth,
                    Expanded(
                      child: Text(
                        e.feature ?? "---",
                        style: context.bodyMedium?.copyWith(
                          color: context.dProvider.black5,
                        ),
                      ),
                    ),
                  ],
                ),
              )).toList(),
            ),
          ),
          
          const Divider(indent: 24, endIndent: 24),
          
          // Footer with Price & Button
          Padding(
            padding: const EdgeInsets.all(24),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          LocalKeys.price,
                          style: context.bodySmall?.copyWith(color: context.dProvider.black5),
                        ),
                        RichText(
                          text: TextSpan(
                            text: subscription.price.toStringAsFixed(2).cur,
                            style: context.titleLarge?.copyWith(
                              fontWeight: FontWeight.bold,
                              color: context.dProvider.primaryColor,
                            ),
                            children: [
                              TextSpan(
                                text: ' /${subscription.subscriptionType?.type}',
                                style: context.bodySmall?.copyWith(color: context.dProvider.black5),
                              ),
                            ],
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
                20.toHeight,
                Consumer<SubscriptionHistoryService>(
                  builder: (context, sh, child) {
                    final isActive = sh.activeSubscriptionId.toString() == subscription.id.toString();
                    return CustomButton(
                      onPressed: isActive ? null : () {
                        showDialog(
                          context: context,
                          builder: (context) => TermsConsentDialog(onAccept: () {
                            final iap = Provider.of<IAPService>(context, listen: false);
                            final storeId = Platform.isIOS
                                ? subscription.appleProductId
                                : subscription.googleProductId;

                            if (storeId != null && storeId.isNotEmpty) {
                              final product = iap.products.firstWhere(
                                  (p) => p.id == storeId,
                                  orElse: () => ProductDetails(
                                      id: "",
                                      title: "",
                                      description: "",
                                      price: "",
                                      rawPrice: 0,
                                      currencyCode: ""));
                              if (product.id.isNotEmpty) {
                                iap.buySubscription(product);
                                return;
                              }
                            }

                            SubscriptionBuyViewModel.dispose;
                            SubscriptionBuyViewModel.instance.setSubId(subscription.id);
                            context.toPage(const SubscriptionBuyView());
                          }),
                        );
                      },
                      btText: isActive 
                        ? "Aktif Paket"
                        : LocalKeys.purchasePlan.capitalizeWords,
                      isLoading: false,
                    );
                  }
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }
}

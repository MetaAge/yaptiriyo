import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/utils/components/custom_future_widget.dart';
import 'package:xilancer/utils/components/custom_refresh_indicator.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/view_models/subscription_store_view_model/subscription_store_view_model.dart';
import 'package:xilancer/views/subscription_store_view/components/subscription_list.dart';
import 'package:xilancer/views/subscription_store_view/components/subscription_list.dart';

import '../../services/subscription_list_service.dart';
import '../../services/subscription_history_service.dart';
import '../../services/iap_service.dart';

class SubscriptionStoreView extends StatelessWidget {
  static const routeName = 'subscription_store_view';
  const SubscriptionStoreView({super.key});
  @override
  Widget build(BuildContext context) {
    final ssm = SubscriptionStoreViewModel.instance;
    return Scaffold(
      appBar: AppBar(
        leading: const NavigationPopIcon(),
        title: Text(LocalKeys.subscription),
      ),
      body: CustomRefreshIndicator(
        onRefresh: () async {
          Provider.of<SubscriptionListService>(context, listen: false)
              .fetchSubscriptionList(refresh: true);
          Provider.of<SubscriptionHistoryService>(context, listen: false)
              .fetchSubscriptionHistory();
        },
        child: CustomFutureWidget(
            shimmer: Container(),
            child: ListView(
              padding: const EdgeInsets.symmetric(vertical: 16),
              children: [
                const SizedBox(
                  height: 600, // Fixed height for carousel
                  child: SubscriptionList(),
                ),
                32.toHeight,
                _buildTrustSection(context),
                40.toHeight,
              ],
            )),
      ),
      // floatingActionButton: IconButton(
      //     onPressed: () {
      //       Provider.of<SubscriptionListService>(context, listen: false)
      //           .fetchSubscriptionList();
      //     },
      //     icon: const Icon(Icons.add_link_rounded)),
    );
  }

  Widget _buildTrustSection(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 24),
      child: Column(
        children: [
          Container(
            padding: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              color: context.dProvider.black9.withOpacity(0.5),
              borderRadius: BorderRadius.circular(20),
            ),
            child: Column(
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.center,
                  children: [
                    Icon(Icons.security_rounded, color: context.dProvider.greenColor, size: 20),
                    8.toWidth,
                    Text(
                      "Güvenli Ödeme Sistemi",
                      style: context.titleSmall?.bold6.copyWith(fontSize: 13),
                    ),
                  ],
                ),
                12.toHeight,
                Text(
                  "Ödemeleriniz uçtan uca şifrelenmiş altyapı ile güvenle gerçekleştirilir.",
                  textAlign: TextAlign.center,
                  style: context.bodySmall?.copyWith(color: context.dProvider.black5),
                ),
              ],
            ),
          ),
          24.toHeight,
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              _trustItem(context, Icons.history_rounded, "Satın Alımları Geri Yükle", () {
                Provider.of<IAPService>(context, listen: false).restorePurchases();
              }),
              Container(height: 24, width: 1, color: context.dProvider.black8),
              _trustItem(context, Icons.help_outline_rounded, "Destek Al", () {
                // Navigate to support
              }),
            ],
          ),
          32.toHeight,
          // Trust Badges
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              _badgeIcon(Icons.verified_user_outlined),
              24.toWidth,
              _badgeIcon(Icons.lock_outline_rounded),
              24.toWidth,
              _badgeIcon(Icons.payment_rounded),
            ],
          ),
        ],
      ),
    );
  }

  Widget _trustItem(BuildContext context, IconData icon, String label, VoidCallback onTap) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(8),
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
        child: Column(
          children: [
            Icon(icon, color: context.dProvider.primaryColor, size: 22),
            8.toHeight,
            Text(
              label,
              style: context.bodySmall?.copyWith(
                fontWeight: FontWeight.w600,
                color: context.dProvider.black3,
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _badgeIcon(IconData icon) {
    return Icon(
      icon,
      color: Colors.grey.withOpacity(0.5),
      size: 28,
    );
  }
}

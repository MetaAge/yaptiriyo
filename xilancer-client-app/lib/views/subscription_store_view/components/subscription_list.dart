import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/iap_service.dart';
import 'dart:io';
import 'package:xilancer/services/subscription_list_service.dart';
import 'package:xilancer/utils/components/custom_future_widget.dart';
import 'package:xilancer/utils/components/custom_preloader.dart';
import 'package:xilancer/utils/components/empty_widget.dart';

import '../../../utils/components/scrolling_preloader.dart';
import '../../../view_models/subscription_store_view_model/subscription_store_view_model.dart';
import 'subscription_card.dart';

class SubscriptionList extends StatelessWidget {
  const SubscriptionList({super.key});

  @override
  Widget build(BuildContext context) {
    final ssm = SubscriptionStoreViewModel.instance;
    ssm.scrollController.addListener(() {
      ssm.tryToLoadMore(context);
    });
    return Consumer<SubscriptionListService>(builder: (context, sl, child) {
      return CustomFutureWidget(
          function: sl.shouldAutoFetch ? sl.fetchSubscriptionList() : null,
          shimmer: const CustomPreloader(),
          isLoading: sl.isLoading,
          child: (sl.subscriptionListModel.subscriptionsData?.subscriptions
                      ?.isEmpty ??
                  true)
              ? EmptyWidget(title: LocalKeys.noSubscriptionsFound)
              : PageView.builder(
                  controller: PageController(viewportFraction: 0.85),
                  itemCount: sl.subscriptionListModel.subscriptionsData!
                      .subscriptions!.length,
                  itemBuilder: (context, index) {
                    final subsItem = sl.subscriptionListModel
                        .subscriptionsData!.subscriptions![index];
                    return Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 8.0, vertical: 20),
                      child: SingleChildScrollView(
                        child: SubscriptionCard(
                          subscription: subsItem,
                        ),
                      ),
                    );
                  },
                ),
          onDataFetched: (data) {
            final productIds = sl
                .subscriptionListModel.subscriptionsData?.subscriptions
                ?.map((e) => Platform.isIOS ? e.appleProductId : e.googleProductId)
                .whereType<String>()
                .toList();
            if (productIds != null && productIds.isNotEmpty) {
              Provider.of<IAPService>(context, listen: false)
                  .initStoreInfo(productIds);
            }
          });
    });
  }
}

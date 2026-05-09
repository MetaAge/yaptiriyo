import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/my_order_list_service.dart';
import 'package:xilancer/utils/components/custom_future_widget.dart';
import 'package:xilancer/utils/components/custom_refresh_indicator.dart';
import 'package:xilancer/view_models/my_orders_view_model/my_orders_view_model.dart';
import 'package:xilancer/views/my_orders_view/components/my_order_card.dart';

import '../../../services/profile_info_service.dart';
import '../../../utils/components/empty_widget.dart';
import '../../../utils/components/scrolling_preloader.dart';
import '../../account_skeleton/account_skeleton.dart';
import 'my_orders_skeleton.dart';

class MyOrdersBody extends StatelessWidget {
  const MyOrdersBody({super.key});

  @override
  Widget build(BuildContext context) {
    final mom = MyOrdersViewModel.instance;
    final olProvider = Provider.of<MyOrderListService>(context, listen: false);

    return Consumer<ProfileInfoService>(builder: (context, pi, child) {
      return pi.profileInfoModel.data == null
          ? Column(
              children: [
                16.toHeight,
                const Expanded(child: AccountSkeleton()),
                16.toHeight,
              ],
            )
          : CustomRefreshIndicator(
              onRefresh: () async {
                await olProvider.fetchOrderList();
              },
              child: CustomFutureWidget(
                  function: olProvider.shouldAutoFetch
                      ? olProvider.fetchOrderList()
                      : null,
                  shimmer: const MyOrdersSkeleton(),
                  child: Consumer<MyOrderListService>(
                      builder: (context, moProvider, child) {
                    return Scrollbar(
                      controller: mom.scrollController,
                      child: moProvider.orderList?.isEmpty != false
                          ? EmptyWidget(title: LocalKeys.noOrderYet)
                          : ListView.separated(
                              controller: mom.scrollController,
                              padding: const EdgeInsets.all(20),
                              itemBuilder: (context, index) {
                                if (moProvider.nextPage != null &&
                                    moProvider.orderList!.length == (index)) {
                                  return ScrollPreloader(
                                      loading: moProvider.nextPageLoading);
                                }

                                final orderItem = moProvider.orderList![index];
                                return MyOrderCard(
                                  id: orderItem.id,
                                   customerName:
                                      "${orderItem.user?.fName ?? ""} ${orderItem.user?.lName ?? ""}",
                                  orderType: orderItem.isCustom
                                      ? LocalKeys.customOrder
                                      : null,
                                  title: orderItem.project?.title ??
                                      orderItem.job?.title ??
                                      LocalKeys.customOrder,
                                  jobStatus: orderItem.isProjectJob,
                                  orderStatus: orderItem.status.toString(),
                                  budget: orderItem.price ?? 0,
                                  jobPrice: orderItem.job?.hourlyRate,
                                  deadline: orderItem.deliveryTime,
                                  rating: orderItem.rating?.isEmpty ?? true
                                      ? null
                                      : orderItem.rating?.first.rating,
                                  customerImage: orderItem.user?.image == null
                                      ? ""
                                      : "${moProvider.myOrdersModel.imagePath}/${orderItem.user?.image}",
                                  paymentStatus: orderItem.paymentStatus,
                                  createdAt: orderItem.createdAt,
                                  isFixedHourly: orderItem.isFixedHourly,
                                  freelancerUsername:
                                      orderItem.user?.username,
                                  freelancerActiveStatus: true,
                                );
                              },
                              separatorBuilder: (context, index) => 16.toHeight,
                              itemCount: moProvider.orderList!.length +
                                  (moProvider.nextPage != null &&
                                          !moProvider.nexLoadingFailed
                                      ? 1
                                      : 0)),
                    );
                  })),
            );
    });
  }
}

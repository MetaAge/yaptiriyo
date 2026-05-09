import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/my_order_list_service.dart';
import 'package:xilancer/utils/components/custom_refresh_indicator.dart';
import 'package:xilancer/view_models/my_orders_view_model/my_orders_view_model.dart';
import 'package:xilancer/views/my_orders_view/components/my_order_card.dart';

import '../../services/profile_info_service.dart';
import '../../utils/components/empty_widget.dart';
import '../../utils/components/scrolling_preloader.dart';
import '../account_skeleton/account_skeleton.dart';
import 'components/my_orders_skeleton.dart';

import '../../services/user_mode_service.dart';
import 'my_orders_and_offers_view.dart';

class MyOrdersView extends StatefulWidget {
  static const routeName = 'my_orders_view';
  const MyOrdersView({super.key});

  @override
  State<MyOrdersView> createState() => _MyOrdersViewState();
}

class _MyOrdersViewState extends State<MyOrdersView> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final olProvider = Provider.of<MyOrderListService>(context, listen: false);
      if (olProvider.shouldAutoFetch) {
        olProvider.fetchOrderList();
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    if (UserModeService.instance.isFreelancer) {
      return const MyOrdersAndOffersView();
    }
    final mom = MyOrdersViewModel.instance;
    final olProvider = Provider.of<MyOrderListService>(context, listen: false);
    mom.scrollController.addListener(() {
      mom.tryToLoadMore(context);
    });
    return Scaffold(
        appBar: AppBar(
          title: Text(LocalKeys.myOrder),
        ),
        body: Consumer<ProfileInfoService>(builder: (context, pi, child) {
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
                  child: Consumer<MyOrderListService>(
                      builder: (context, moProvider, child) {
                    if (moProvider.orderList == null) {
                      return const MyOrdersSkeleton();
                    }
                    return Scrollbar(
                      controller: mom.scrollController,
                      child: moProvider.orderList?.isEmpty != false
                          ? EmptyWidget(title: LocalKeys.noOrderYet)
                          : ListView.separated(
                              controller: mom.scrollController,
                              padding: const EdgeInsets.fromLTRB(20, 20, 20, 120),
                              itemBuilder: (context, index) {
                                if (moProvider.nextPage != null &&
                                    moProvider.orderList!.length ==
                                        (index)) {
                                  return ScrollPreloader(
                                      loading: moProvider.nextPageLoading);
                                }

                                final orderItem =
                                    moProvider.orderList![index];
                                return MyOrderCard(
                                  id: orderItem.id,
                                  customerName:
                                      "${orderItem.freelancer?.firstName ?? ""} ${orderItem.freelancer?.lastName ?? ""}",
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
                                  customerImage: orderItem
                                          .freelancer?.cloudImage ??
                                      "${orderItem.freelancer?.image?.profileImage}",
                                  paymentStatus: orderItem.paymentStatus,
                                  createdAt: orderItem.createdAt,
                                  isFixedHourly: orderItem.isFixedHourly,
                                );
                              },
                              separatorBuilder: (context, index) =>
                                  16.toHeight,
                              itemCount: moProvider.orderList!.length +
                                  (moProvider.nextPage != null &&
                                          !moProvider.nexLoadingFailed
                                      ? 1
                                      : 0)),
                    );
                  }),
                );
        }));
  }
}

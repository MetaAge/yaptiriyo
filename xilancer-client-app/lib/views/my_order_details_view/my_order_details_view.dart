import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/order_details_service.dart';
import 'package:xilancer/utils/components/custom_future_widget.dart';
import 'package:xilancer/utils/components/custom_refresh_indicator.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/view_models/my_order_details_view_model/my_order_details_view_model.dart';
import 'package:xilancer/views/my_order_details_view/components/order_rating_dialog.dart';
import 'package:xilancer/views/my_order_details_view/components/order_details_tabs.dart';
import 'package:xilancer/views/my_order_details_view/components/order_details_titles.dart';
import 'package:xilancer/views/my_orders_view/components/my_order_card_infos.dart';
import 'package:xilancer/views/my_order_details_view/components/order_address_info.dart';

import 'components/my_order_details_skeleton.dart';

import '../../utils/components/alerts.dart';
import '../../services/user_mode_service.dart';
import '../work_submit_view/work_submit_view.dart';

class MyOrderDetailsView extends StatelessWidget {
  static const routeName = 'my_order_details_view';
  const MyOrderDetailsView({super.key});
  @override
  Widget build(BuildContext context) {
    MyOrderDetailsViewModel.dispose;
    final odProvider = Provider.of<OrderDetailsService>(context, listen: false);
    final orderId = ModalRoute.of(context)?.settings.arguments;
    final isFreelancer = UserModeService.instance.isFreelancer;
    return Scaffold(
        appBar: AppBar(
          leading: const NavigationPopIcon(),
          title: Text(LocalKeys.myOrder),
        ),
        body: CustomRefreshIndicator(
          onRefresh: () async {
            await odProvider.fetchOrderDetails(orderId: orderId);
          },
          child: CustomFutureWidget(
              function: odProvider.shouldAutoFetch(orderId)
                  ? odProvider.fetchOrderDetails(orderId: orderId)
                  : null,
              shimmer: const MyOrderSkeleton(),
              child:
                  Consumer<OrderDetailsService>(builder: (context, od, child) {
                final orderDetails = od.orderDetailsModel.orderDetails!;
                return ListView(
                  padding: const EdgeInsets.all(20),
                  children: [
                    Container(
                      padding: const EdgeInsets.symmetric(vertical: 20),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(8),
                        color: context.dProvider.whiteColor,
                      ),
                      child: MyOrderCardInfos(
                        id: orderId,
                        customerName: isFreelancer
                            ? "${orderDetails.user?.fName ?? ""} ${orderDetails.user?.lName ?? ""}"
                            : "${orderDetails.freelancer?.firstName ?? ""} ${orderDetails.freelancer?.lastName ?? ""}",
                        budget: orderDetails.price,
                        orderType: orderDetails.isCustom
                            ? LocalKeys.customOrder
                            : null,
                        orderStatus: orderDetails.status.toString(),
                        title: orderDetails.project?.title ??
                            orderDetails.job?.title ??
                            LocalKeys.customOrder,
                        jobStatus: orderDetails.isProjectJob,
                        deadline: orderDetails.deliveryTime,
                        rating: orderDetails.rating?.isEmpty ?? true
                            ? null
                            : orderDetails.rating!.first.rating,
                        customerImage: isFreelancer
                            ? (orderDetails.user?.image == null
                                ? ""
                                : "${od.orderDetailsModel.imagePath}/${orderDetails.user?.image}")
                            : (orderDetails.freelancer?.cloudImage ??
                                (orderDetails.freelancer?.image?.profileImage ==
                                        null
                                    ? ""
                                    : "${od.orderDetailsModel.imagePath}/${orderDetails.freelancer?.image?.profileImage}")),
                        paymentStatus: orderDetails.paymentStatus,
                        fromDetails: true,
                        createdAt: orderDetails.createdAt,
                        jobPrice: orderDetails.job?.hourlyRate,
                        estimatedHours: orderDetails.job?.estimatedHours,
                        isFixedHourly: orderDetails.isFixedHourly,
                        freelancerUsername: isFreelancer
                            ? orderDetails.user?.username
                            : orderDetails.freelancer?.username,
                        freelancerActiveStatus: isFreelancer
                            ? true
                            : orderDetails.freelancer?.userActiveInactiveStatus ??
                                false,
                      ),
                    ),
                    if (isFreelancer && orderDetails.status.toString() == "0")
                      Padding(
                        padding: const EdgeInsets.only(top: 20),
                        child: Row(
                          children: [
                            Expanded(
                              child: ElevatedButton(
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: context.dProvider.greenColor,
                                  foregroundColor: context.dProvider.whiteColor,
                                ),
                                onPressed: () {
                                  Alerts().confirmationAlert(
                                    context: context,
                                    title: LocalKeys.areYouSure,
                                    description: LocalKeys.acceptOrderQ,
                                    onConfirm: () async {
                                      await odProvider.acceptOrder(
                                          orderId: orderId);
                                      if (context.mounted) {
                                        Navigator.pop(context);
                                      }
                                    },
                                    buttonColor: context.dProvider.greenColor,
                                  );
                                },
                                child: Text(LocalKeys.accept),
                              ),
                            ),
                            12.toWidth,
                            Expanded(
                              child: ElevatedButton(
                                style: ElevatedButton.styleFrom(
                                  backgroundColor:
                                      context.dProvider.primaryColor,
                                  foregroundColor: context.dProvider.whiteColor,
                                ),
                                onPressed: () {
                                  Alerts().confirmationAlert(
                                    context: context,
                                    title: LocalKeys.areYouSure,
                                    description: LocalKeys.areYouSureToCancel,
                                    onConfirm: () async {
                                      await odProvider.declineOrder(
                                          orderId: orderId);
                                      if (context.mounted) {
                                        Navigator.pop(context);
                                      }
                                    },
                                    buttonColor: context.dProvider.primaryColor,
                                  );
                                },
                                child: Text(LocalKeys.decline),
                              ),
                            ),
                          ],
                        ),
                      ),
                    if (isFreelancer && orderDetails.status.toString() == "1")
                      Padding(
                        padding: const EdgeInsets.only(top: 20),
                        child: SizedBox(
                          width: double.infinity,
                          child: ElevatedButton(
                            onPressed: () {
                              context.toPage(WorkSubmitView(
                                  orderId: orderId, milestoneId: null));
                            },
                            child: Text(LocalKeys.submitWork),
                          ),
                        ),
                      ),
                    if (!isFreelancer && orderDetails.status.toString() == "3")
                      Padding(
                        padding: const EdgeInsets.only(top: 20),
                        child: Builder(builder: (context) {
                          final hasRated = orderDetails.rating
                                  ?.any((e) => e.senderType.toString() == "1") ??
                              false;
                          return SizedBox(
                            width: double.infinity,
                            child: ElevatedButton(
                              style: ElevatedButton.styleFrom(
                                backgroundColor: hasRated
                                    ? context.dProvider.hintColor
                                    : context.dProvider.greenColor,
                                foregroundColor: context.dProvider.whiteColor,
                              ),
                              onPressed: hasRated
                                  ? null
                                  : () {
                                      showModalBottomSheet(
                                        context: context,
                                        builder: (context) => OrderRatingDialog(
                                          orderId: orderId,
                                        ),
                                        isScrollControlled: true,
                                      );
                                    },
                              child: Text(hasRated ? LocalKeys.rated : LocalKeys.rateNow),
                            ),
                          );
                        }),
                      ),
                    OrderAddressInfo(
                      address: orderDetails.serviceAddress,
                      city: orderDetails.city?.name,
                      state: orderDetails.state?.name,
                      country: orderDetails.country?.name,
                      appointmentDate: orderDetails.appointmentDate,
                      appointmentTime: orderDetails.appointmentTime,
                    ),
                    20.toHeight,
                    const OrderDetailsTitles(orderHaveMilestone: true),
                    12.toHeight,
                    const OrderDetailsTabs(orderHaveMilestone: true),
                    20.toHeight,
                  ],
                );
              })),
        ));
  }
}

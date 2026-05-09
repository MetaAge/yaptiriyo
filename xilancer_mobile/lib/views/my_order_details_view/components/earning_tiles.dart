import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/widget_extension.dart';
import 'package:xilancer/services/order_details_service.dart';

import '../../../helper/local_keys.g.dart';
import 'hourly_price_info_tile.dart';

class EarningTiles extends StatelessWidget {
  const EarningTiles({super.key});

  @override
  Widget build(BuildContext context) {
    return Consumer<OrderDetailsService>(builder: (context, od, child) {
      final orderDetails = od.orderDetailsModel.orderDetails;
      if (orderDetails == null) {
        return const SizedBox();
      }
      return Wrap(
        spacing: 8,
        runSpacing: 8,
        children: [
          // 12.toHeight,
          HourlyPriceInfoTile(
              price: orderDetails.status.toString() == "3"
                  ? orderDetails.payableAmount ?? 0
                  : 0,
              priceNote: "",
              status: LocalKeys.earnedBalance,
              color: context.dProvider.gridColors[0],
              desc: LocalKeys.earnedBalanceDesc),
          // 12.toHeight,
          orderDetails.isFixedHourly != "hourly"
              ? HourlyPriceInfoTile(
                  price: orderDetails.status.toString() != "3"
                      ? orderDetails.payableAmount ?? 0
                      : 0,
                  priceNote: "",
                  status: LocalKeys.pendingBalance,
                  color: context.dProvider.gridColors[1],
                  desc: LocalKeys.pendingBalanceDesc)
              : HourlyPriceInfoTile(
                  price: orderDetails.job?.hourlyRate ?? 0,
                  priceNote: "",
                  status: LocalKeys.hourlyRate,
                  color: context.dProvider.gridColors[1],
                  desc: LocalKeys.hourlyRateDesc),
          // 12.toHeight,
          (orderDetails.isFixedHourly != "hourly" ||
                  orderDetails.status.toString() == "3")
              ? HourlyPriceInfoTile(
                  price: orderDetails.commissionAmount,
                  priceNote: "",
                  status: LocalKeys.commissionAmount,
                  color: context.dProvider.gridColors[2],
                  desc: LocalKeys.commissionBalanceDesc)
              : HourlyPriceInfoTile(
                  price: orderDetails.job?.estimatedHours ?? 0,
                  priceNote: "",
                  status: LocalKeys.estimatedHours,
                  color: context.dProvider.gridColors[2],
                  desc: LocalKeys.estimatedHoursDesc),
          // 12.toHeight,
          HourlyPriceInfoTile(
              price: orderDetails.price,
              priceNote: "",
              status: (orderDetails.isFixedHourly != "hourly" ||
                      orderDetails.status.toString() == "3")
                  ? LocalKeys.totalBudget
                  : LocalKeys.approximateBudget,
              color: context.dProvider.gridColors[3],
              desc: LocalKeys.totalBudgetDesc),
        ],
      ).hp20;
    });
  }
}

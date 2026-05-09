import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

import '../../../helper/local_keys.g.dart';

class WalletHistoryTile extends StatelessWidget {
  final String amount;
  final String pStatus;
  final String pMethod;
  final DateTime? cDate;
  final String? type;
  const WalletHistoryTile({
    super.key,
    required this.amount,
    required this.pStatus,
    required this.pMethod,
    this.cDate,
    this.type,
  });

  @override
  Widget build(BuildContext context) {
    final bool isCompleted = pStatus.toLowerCase() == "complete" ||
        pStatus.toLowerCase() == "completed" ||
        pStatus.toLowerCase() == "success";

    final bool isWithdraw = type?.toLowerCase() == "withdraw";

    final Color statusColor = isWithdraw
        ? context.dProvider.primaryColor // Red/Primary for exit
        : (isCompleted
            ? context.dProvider.greenColor
            : context.dProvider.black5);

    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.02),
            blurRadius: 10,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(12),
            decoration: BoxDecoration(
              color: statusColor.withOpacity(0.1),
              shape: BoxShape.circle,
            ),
            child: Icon(
              isWithdraw
                  ? Icons.arrow_upward_rounded
                  : (isCompleted
                      ? Icons.arrow_downward_rounded
                      : Icons.history_rounded),
              color: statusColor,
              size: 20,
            ),
          ),
          16.toWidth,
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  pMethod.replaceAll("_", " ").capitalize,
                  style: context.titleMedium?.bold6.copyWith(
                    color: context.dProvider.black2,
                    fontSize: 15,
                  ),
                ),
                4.toHeight,
                Text(
                  DateFormat("MMM dd, yyyy", dProvider.languageSlug)
                      .format(cDate ?? DateTime.now()),
                  style: context.bodySmall?.copyWith(
                    color: context.dProvider.black5,
                  ),
                ),
              ],
            ),
          ),
          Column(
            crossAxisAlignment: CrossAxisAlignment.end,
            children: [
              Text(
                "${isWithdraw ? "- " : "+ "}${amount.cur}",
                style: context.titleMedium?.bold.copyWith(
                  color: statusColor,
                ),
              ),
              6.toHeight,
              Container(
                padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                decoration: BoxDecoration(
                  color: (isCompleted
                          ? (isWithdraw
                              ? context.dProvider.primaryColor
                              : context.dProvider.greenColor)
                          : context.dProvider.warningColor)
                      .withOpacity(0.1),
                  borderRadius: BorderRadius.circular(6),
                ),
                child: Text(
                  pStatus.getWalletStatus,
                  style: context.bodySmall?.copyWith(
                    fontSize: 10,
                    fontWeight: FontWeight.bold,
                    color: isCompleted
                        ? (isWithdraw
                            ? context.dProvider.primaryColor
                            : context.dProvider.greenColor)
                        : context.dProvider.warningColor,
                  ),
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}

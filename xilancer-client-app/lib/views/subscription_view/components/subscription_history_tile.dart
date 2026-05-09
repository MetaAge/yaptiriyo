import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';

import '../../../helper/local_keys.g.dart';

class SubscriptionHistoryTile extends StatelessWidget {
  final String limit;
  final String type;
  final String price;
  final String sStatus;
  final String pStatus;
  final DateTime? pDate;
  final DateTime eDate;
  const SubscriptionHistoryTile(
      {super.key,
      required this.limit,
      required this.type,
      required this.price,
      required this.sStatus,
      required this.pStatus,
      this.pDate,
      required this.eDate});

  @override
  Widget build(BuildContext context) {
    final isDark = Theme.of(context).brightness == Brightness.dark;
    return Container(
      margin: const EdgeInsets.only(bottom: 12),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(isDark ? 0.2 : 0.03),
            blurRadius: 10,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      "$limit Teklif Hakkı",
                      style: context.titleMedium?.bold6,
                    ),
                    Text(
                      type,
                      style: context.bodySmall?.copyWith(color: context.dProvider.black5),
                    ),
                  ],
                ),
              ),
              Container(
                padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 6),
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(20),
                  color: statusColor.withOpacity(0.1),
                  border: Border.all(color: statusColor.withOpacity(0.2)),
                ),
                child: Text(
                  subsStatus,
                  style: context.titleSmall?.copyWith(
                    color: statusColor,
                    fontSize: 12,
                    fontWeight: FontWeight.bold,
                  ),
                ),
              ),
            ],
          ),
          16.toHeight,
          Row(
            children: [
              _infoChip(
                context, 
                Icons.payment_rounded, 
                LocalKeys.complete, 
                context.dProvider.greenColor,
              ),
              12.toWidth,
              _infoChip(
                context, 
                Icons.calendar_today_rounded, 
                DateFormat("MMM dd, yyyy", dProvider.languageSlug).format(eDate), 
                eDateColor,
              ),
            ],
          ),
        ],
      ),
    );
  }

  Widget _infoChip(BuildContext context, IconData icon, String label, Color color) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
      decoration: BoxDecoration(
        color: context.dProvider.black9,
        borderRadius: BorderRadius.circular(8),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(icon, size: 14, color: color),
          8.toWidth,
          Text(
            label,
            style: context.bodySmall?.copyWith(
              color: context.dProvider.black3,
              fontWeight: FontWeight.w600,
            ),
          ),
        ],
      ),
    );
  }

  Color get eDateColor {
    final now = DateTime.now();
    if (eDate.isBefore(now)) {
      return dProvider.black3;
    }
    if (eDate.difference(now).inDays < 7) {
      return dProvider.yellowColor;
    }
    return dProvider.primaryColor;
  }

  String get subsStatus {
    if (sStatus == "0") {
      return LocalKeys.inactive;
    }
    if (DateTime.now().isAfter(eDate)) {
      return LocalKeys.expired;
    }
    return LocalKeys.active;
  }

  Color get statusColor {
    if (sStatus == "0") {
      return dProvider.yellowColor;
    }
    if (DateTime.now().isAfter(eDate)) {
      return dProvider.warningColor;
    }
    return dProvider.greenColor;
  }
}

import 'package:flutter/material.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/helper/extension/context_extension.dart';

import '../../helper/local_keys.g.dart';

class ProTag extends StatelessWidget {
  final bool isPro;
  final DateTime? proExpDate;
  final EdgeInsetsGeometry? margin;
  const ProTag({
    super.key,
    required this.isPro,
    this.proExpDate,
    this.margin,
  });

  @override
  Widget build(BuildContext context) {
    final DateTime now = DateTime.now();
    if (!isPro || now.isAfter(proExpDate ?? now.subtract(const Duration(days: 1)))) {
      return const SizedBox();
    }
    return Container(
      margin: margin ?? const EdgeInsets.all(12),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(20),
        gradient: const LinearGradient(
          colors: [Color(0xFF8E2DE2), Color(0xFF4A00E0)], // Premium Purple Gradient
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        boxShadow: [
          BoxShadow(
            color: const Color(0xFF4A00E0).withOpacity(0.3),
            blurRadius: 8,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 14, vertical: 8),
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(20),
          color: Colors.white.withOpacity(0.1),
        ),
        child: Row(
          mainAxisSize: MainAxisSize.min,
          children: [
            Container(
              padding: const EdgeInsets.all(3),
              decoration: const BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.white,
              ),
              child: const Icon(
                Icons.rocket_launch_rounded,
                size: 10,
                color: Color(0xFF4A00E0),
              ),
            ),
            const SizedBox(width: 8),
            Text(
              "SPONSORLU",
              style: context.titleSmall?.bold6.copyWith(
                color: Colors.white,
                fontSize: 10,
                letterSpacing: 1.1,
              ),
            ),
            if (proExpDate != null) ...[
              const SizedBox(width: 4),
              Text(
                "• ${proExpDate!.difference(now).inDays + 1} GÜN KALDI",
                style: context.titleSmall?.bold6.copyWith(
                  color: Colors.white.withOpacity(0.9),
                  fontSize: 10,
                  letterSpacing: 1.1,
                ),
              ),
            ],
          ],
        ),
      ),
    );
  }
}

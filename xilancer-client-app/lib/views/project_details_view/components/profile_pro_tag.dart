import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';

import '../../../customizations.dart';
import '../../../helper/constant_helper.dart';
import '../../../helper/local_keys.g.dart';

class ProfileProTag extends StatelessWidget {
  final bool isPro;
  final DateTime? proExpDate;
  const ProfileProTag({
    super.key,
    required this.isPro,
    this.proExpDate,
  });

  @override
  Widget build(BuildContext context) {
    final DateTime now = DateTime.now();
    if (!isPro) {
      return SizedBox();
    }
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 10, vertical: 4),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(20),
        gradient: LinearGradient(
          colors: [
            proTagColor,
            proTagColor.withOpacity(0.8),
          ],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        boxShadow: [
          BoxShadow(
            color: proTagColor.withOpacity(0.2),
            blurRadius: 4,
            offset: Offset(0, 2),
          ),
        ],
        border: Border.all(color: Colors.white.withOpacity(0.2), width: 1),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(
            Icons.verified_rounded,
            size: 14,
            color: Colors.white,
          ),
          SizedBox(width: 6),
          Text(
            "Onaylı Usta",
            style: context.titleSmall?.copyWith(
              color: Colors.white,
              fontWeight: FontWeight.w600,
              fontSize: 12,
            ),
          ),
        ],
      ),
    );

  }
}

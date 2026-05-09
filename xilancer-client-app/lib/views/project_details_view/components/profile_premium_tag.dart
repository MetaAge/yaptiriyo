import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';

import '../../../customizations.dart';
import '../../../helper/constant_helper.dart';
import '../../../helper/local_keys.g.dart';

class ProfilePremiumTag extends StatelessWidget {
  final bool isPremium;
  const ProfilePremiumTag({
    super.key,
    required this.isPremium,
  });

  @override
  Widget build(BuildContext context) {
    if (!isPremium) {
      return SizedBox();
    }
    return Container(
      padding: EdgeInsets.symmetric(horizontal: 10, vertical: 4),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(20),
        gradient: LinearGradient(
          colors: [
            premiumTagColor,
            Color(0xffFF8C00),
          ],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        boxShadow: [
          BoxShadow(
            color: premiumTagColor.withOpacity(0.3),
            blurRadius: 6,
            offset: Offset(0, 3),
          ),
        ],
        border: Border.all(color: Colors.white.withOpacity(0.3), width: 1),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(
            Icons.stars_rounded,
            size: 14,
            color: Colors.white,
          ),
          SizedBox(width: 6),
          Text(
            "Premium",
            style: context.titleSmall?.copyWith(
              color: Colors.white,
              fontWeight: FontWeight.bold,
              fontSize: 12,
              letterSpacing: 0.5,
            ),
          ),
        ],
      ),
    );

  }
}

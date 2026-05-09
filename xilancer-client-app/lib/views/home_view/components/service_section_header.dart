import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';

class ServiceSectionHeader extends StatelessWidget {
  final String title;
  final IconData? icon;
  final VoidCallback? onSeeAll;
  const ServiceSectionHeader({
    super.key,
    required this.title,
    this.icon,
    this.onSeeAll,
  });

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 16),
      child: Row(
        mainAxisAlignment: MainAxisAlignment.spaceBetween,
        children: [
          Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                children: [
                  if (icon != null) ...[
                    Icon(icon, size: 20, color: context.dProvider.primaryColor),
                    const SizedBox(width: 8),
                  ],
                  Text(
                    title,
                    style: context.titleMedium?.copyWith(
                      fontWeight: FontWeight.bold,
                      fontSize: 18,
                      color: context.dProvider.black2,
                    ),
                  ),
                ],
              ),
              const SizedBox(height: 4),
              Container(
                width: 32,
                height: 3,
                decoration: BoxDecoration(
                  color: context.dProvider.primaryColor,
                  borderRadius: BorderRadius.circular(2),
                ),
              ),
            ],
          ),
          if (onSeeAll != null)
            InkWell(
              onTap: onSeeAll,
              borderRadius: BorderRadius.circular(20),
              child: Container(
                padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                decoration: BoxDecoration(
                  color: context.dProvider.primaryColor.withOpacity(0.1),
                  borderRadius: BorderRadius.circular(20),
                ),
                child: Row(
                  children: [
                    Text(
                      "Tümünü Gör",
                      style: TextStyle(
                        color: context.dProvider.primaryColor,
                        fontWeight: FontWeight.bold,
                        fontSize: 12,
                      ),
                    ),
                    const SizedBox(width: 4),
                    Icon(Icons.arrow_forward_ios_rounded, size: 10, color: context.dProvider.primaryColor),
                  ],
                ),
              ),
            ),
        ],
      ),
    );
  }
}

import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';

class PackageDetailRow extends StatelessWidget {
  final String label;
  final String? value;
  final Widget? trailing;
  final Widget? icon;
  final bool isLast;

  const PackageDetailRow({
    super.key,
    required this.label,
    this.value,
    this.trailing,
    this.icon,
    this.isLast = false,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(vertical: 18, horizontal: 20),
      child: Row(
        children: [
          if (icon != null) ...[
            Container(
              padding: const EdgeInsets.all(8),
              decoration: BoxDecoration(
                color: context.dProvider.primaryColor.withOpacity(0.08),
                borderRadius: BorderRadius.circular(10),
              ),
              child: icon!,
            ),
            const SizedBox(width: 14),
          ],
          Expanded(
            flex: 2,
            child: Text(
              label,
              style: context.titleSmall?.copyWith(
                color: context.dProvider.black5,
                fontWeight: FontWeight.w600,
                fontSize: 14,
              ),
            ),
          ),
          const SizedBox(width: 8),
          Expanded(
            flex: 3,
            child: Align(
              alignment: Alignment.centerRight,
              child: trailing ??
                  Text(
                    value?.toString() ?? "",
                    textAlign: TextAlign.end,
                    style: context.titleSmall?.copyWith(
                      color: context.dProvider.black2,
                      fontWeight: FontWeight.w800,
                      fontSize: 15,
                    ),
                  ),
            ),
          ),
        ],
      ),
    );
  }
}

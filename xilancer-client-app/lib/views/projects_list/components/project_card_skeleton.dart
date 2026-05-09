import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/widget_extension.dart';
import 'package:xilancer/utils/components/text_skeleton.dart';


class ProjectCardSkeleton extends StatelessWidget {
  const ProjectCardSkeleton({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(24),
        color: context.dProvider.whiteColor,
        border: Border.all(color: context.dProvider.black9.withOpacity(0.08)),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Container(
            height: 180,
            width: double.infinity,
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(20),
              color: context.dProvider.black8,
            ),
          ),
          16.toHeight,
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Container(
                height: 20,
                width: 80,
                decoration: BoxDecoration(
                  color: context.dProvider.black8,
                  borderRadius: BorderRadius.circular(8),
                ),
              ),
              Container(
                height: 16,
                width: 60,
                decoration: BoxDecoration(
                  color: context.dProvider.black8,
                  borderRadius: BorderRadius.circular(6),
                ),
              ),
            ],
          ),
          16.toHeight,
          Container(
            height: 20,
            width: double.infinity,
            decoration: BoxDecoration(
              color: context.dProvider.black8,
              borderRadius: BorderRadius.circular(6),
            ),
          ),
          8.toHeight,
          Container(
            height: 20,
            width: 150,
            decoration: BoxDecoration(
              color: context.dProvider.black8,
              borderRadius: BorderRadius.circular(6),
            ),
          ),
          20.toHeight,
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Container(
                height: 24,
                width: 100,
                decoration: BoxDecoration(
                  color: context.dProvider.black8,
                  borderRadius: BorderRadius.circular(8),
                ),
              ),
              Container(
                height: 40,
                width: 40,
                decoration: BoxDecoration(
                  color: context.dProvider.black8,
                  shape: BoxShape.circle,
                ),
              ),
            ],
          ),
        ],
      ),
    );
  }
}

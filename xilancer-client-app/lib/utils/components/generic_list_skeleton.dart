import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/widget_extension.dart';
import 'package:xilancer/utils/components/text_skeleton.dart';

class GenericListSkeleton extends StatelessWidget {
  final int count;
  const GenericListSkeleton({super.key, this.count = 5});

  @override
  Widget build(BuildContext context) {
    return ListView.builder(
      shrinkWrap: true,
      physics: const NeverScrollableScrollPhysics(),
      itemCount: count,
      itemBuilder: (context, index) {
        return Container(
          margin: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
          padding: const EdgeInsets.all(16),
          decoration: BoxDecoration(
            color: context.dProvider.whiteColor,
            borderRadius: BorderRadius.circular(8),
            border: Border.all(color: context.dProvider.black8),
          ),
          child: Row(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Container(
                height: 48,
                width: 48,
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  color: context.dProvider.black8,
                ),
              ),
              16.toWidth,
              Expanded(
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    TextSkeleton(
                      height: 16,
                      width: context.width * 0.4,
                    ),
                    8.toHeight,
                    TextSkeleton(
                      height: 12,
                      width: context.width * 0.6,
                    ),
                    8.toHeight,
                    const TextSkeleton(
                      height: 12,
                      width: 80,
                    ),
                  ],
                ),
              ),
            ],
          ),
        ).shim;
      },
    );
  }
}

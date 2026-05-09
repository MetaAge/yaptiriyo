import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/view_models/create_project_view_model/create_project_view_model.dart';

class GigScoreBar extends StatelessWidget {
  const GigScoreBar({super.key});

  @override
  Widget build(BuildContext context) {
    final cpm = CreateProjectViewModel.instance;
    return ValueListenableBuilder<int>(
      valueListenable: cpm.gigScore,
      builder: (context, score, child) {
        Color barColor;
        String statusText;
        if (score >= 80) {
          barColor = Colors.green;
          statusText = LocalKeys.excellentQuality;
        } else if (score >= 50) {
          barColor = Colors.orange;
          statusText = LocalKeys.goodQuality;
        } else {
          barColor = Colors.red;
          statusText = LocalKeys.needsImprovement;
        }

        return Container(
          padding: const EdgeInsets.all(16),
          color: context.dProvider.black9,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    LocalKeys.serviceQualityScore,
                    style: context.titleSmall?.bold6,
                  ),
                  Text(
                    "$score%",
                    style: context.titleSmall?.bold6.copyWith(color: barColor),
                  ),
                ],
              ),
              const SizedBox(height: 8),
              ClipRRect(
                borderRadius: BorderRadius.circular(4),
                child: LinearProgressIndicator(
                  value: score / 100,
                  backgroundColor: context.dProvider.black8,
                  color: barColor,
                  minHeight: 8,
                ),
              ),
              const SizedBox(height: 4),
              Text(
                statusText,
                style: context.bodySmall,
              ),
            ],
          ),
        );
      },
    );
  }
}

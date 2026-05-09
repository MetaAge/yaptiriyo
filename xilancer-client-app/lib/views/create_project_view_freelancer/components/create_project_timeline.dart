import 'package:flutter/material.dart';
import 'package:xilancer/view_models/create_project_view_model/create_project_view_model.dart';
import '../../../helper/local_keys.g.dart';
import '../../../utils/components/empty_spacer_helper.dart';
import '/helper/extension/context_extension.dart';
import 'create_project_title_timeline.dart';

class CreateProjectTimeline extends StatelessWidget {
  const CreateProjectTimeline({
    super.key,
    required this.cpv,
  });

  final CreateProjectViewModel cpv;

  @override
  Widget build(BuildContext context) {
    return Container(
        padding: const EdgeInsets.symmetric(vertical: 24, horizontal: 20),
        decoration: BoxDecoration(
          color: context.dProvider.whiteColor,
          border: Border(
            bottom: BorderSide(color: context.dProvider.black8.withOpacity(0.5), width: 1),
          ),
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            const CreateProjectTitleTimeline(),
            const SizedBox(height: 24),
            Row(
              children: [
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      ValueListenableBuilder(
                        valueListenable: cpv.currentIndex,
                        builder: (context, value, child) => Text(
                          cpv.timelineDescriptions[value.toInt()],
                          style: context.titleMedium?.copyWith(
                            fontWeight: FontWeight.bold,
                            color: context.dProvider.black2,
                          ),
                        ),
                      ),
                      const SizedBox(height: 4),
                      ValueListenableBuilder(
                        valueListenable: cpv.currentIndex,
                        builder: (context, value, child) => Text(
                          "Adım ${value.toInt() + 1} / ${cpv.timelineList.length}",
                          style: context.bodySmall?.copyWith(
                            color: context.dProvider.black5,
                            fontWeight: FontWeight.w500,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
                ValueListenableBuilder(
                  valueListenable: cpv.currentIndex,
                  builder: (context, value, child) => cpv.timelineList.length ==
                          (value + 1)
                      ? const SizedBox()
                      : Container(
                          padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(10),
                            color: context.dProvider.primaryColor.withOpacity(0.1),
                          ),
                          child: Row(
                            mainAxisSize: MainAxisSize.min,
                            children: [
                              Text(
                                "${LocalKeys.next}: ",
                                style: context.bodySmall?.copyWith(
                                  color: context.dProvider.primaryColor,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                              Text(
                                cpv.timelineList[value.toInt() + 1],
                                style: context.bodySmall?.copyWith(
                                  color: context.dProvider.primaryColor,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ],
                          ),
                        ),
                ),
              ],
            ),
          ],
        ));
  }
}

import 'package:flutter/material.dart';
import 'package:flutter_widget_from_html/flutter_widget_from_html.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/services/project_details_service.dart';
import 'package:xilancer/views/project_details_view/components/project_details_service_areas.dart';
import 'package:xilancer/views/project_details_view/components/pro_tag.dart';

class ProjectDetailsBasicInfo extends StatelessWidget {
  final bool showEdit;
  final projectId;
  const ProjectDetailsBasicInfo(
      {super.key, this.showEdit = true, this.projectId});

  @override
  Widget build(BuildContext context) {
    final pdProvider =
        Provider.of<ProjectDetailsService>(context, listen: false);
    final projectDetails =
        pdProvider.projectDetailsModel[projectId.toString()]?.projectDetails;
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(24),
          color: context.dProvider.whiteColor,
          border: Border.all(color: context.dProvider.black9.withOpacity(0.08)),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withOpacity(0.04),
              blurRadius: 30,
              offset: const Offset(0, 10),
            ),
          ]),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            children: [
              if (projectDetails != null)
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                  decoration: BoxDecoration(
                    color: context.dProvider.primaryColor.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Text(
                    (projectDetails.projectCategory?.name ?? "---").toUpperCase(),
                    style: context.bodySmall!.copyWith(
                      color: context.dProvider.primaryColor,
                      fontWeight: FontWeight.bold,
                      letterSpacing: 0.5,
                      fontSize: 10,
                    ),
                  ),
                ),
              const Spacer(),
              if (projectDetails != null && projectDetails.createdAt != null)
                Text(
                  "${projectDetails.createdAt!.day}.${projectDetails.createdAt!.month}.${projectDetails.createdAt!.year}",
                  style: context.bodySmall?.copyWith(
                    color: context.dProvider.black5,
                    fontSize: 11,
                    fontWeight: FontWeight.w500,
                  ),
                ),
            ],
          ),
          if (projectDetails?.proExpDate != null) ...[
            12.toHeight,
            ProTag(
              isPro: projectDetails!.isPro,
              proExpDate: projectDetails.proExpDate,
              margin: EdgeInsets.zero,
            ),
          ],
          16.toHeight,
          Text(
            projectDetails?.title ?? "---",
            style: context.titleLarge?.copyWith(
              fontSize: 24,
              fontWeight: FontWeight.bold,
              height: 1.25,
              color: context.dProvider.black2,
            ),
          ),
          20.toHeight,
          ProjectDetailsServiceAreas(serviceAreas: projectDetails?.serviceAreas),
          24.toHeight,
          Row(
            children: [
              Container(
                width: 4,
                height: 18,
                decoration: BoxDecoration(
                  color: context.dProvider.primaryColor,
                  borderRadius: BorderRadius.circular(2),
                ),
              ),
              const SizedBox(width: 10),
              Text(
                "Hizmet Açıklaması",
                style: context.titleMedium?.copyWith(
                  fontWeight: FontWeight.bold,
                  color: context.dProvider.black2,
                ),
              ),
            ],
          ),
          12.toHeight,
          HtmlWidget(
            projectDetails?.description ?? "",
            textStyle: context.bodyMedium?.copyWith(
              color: context.dProvider.black3,
              height: 1.7,
              fontSize: 15,
            ),
          ),
        ],
      ),
    );
  }
}

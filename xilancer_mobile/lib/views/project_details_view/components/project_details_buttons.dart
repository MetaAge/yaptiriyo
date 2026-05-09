import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/svg_assets.dart';
import 'package:xilancer/services/project_details_service.dart';
import 'package:xilancer/view_models/create_project_view_model/create_project_view_model.dart';
import 'package:xilancer/view_models/project_details_view_model/project_details_view_model.dart';
import 'package:xilancer/views/create_project_view/create_project_view.dart';

import '../../../helper/local_keys.g.dart';
import '../../../services/module_list_service.dart';
import '../../../view_models/promotion_payment_view_model/promotion_payment_view_model.dart';
import '../../promotion_payment_view/promotion_payment_view.dart';

class ProjectDetailsButtons extends StatelessWidget {
  final ProjectDetailsService pd;
  const ProjectDetailsButtons({super.key, required this.pd});

  @override
  Widget build(BuildContext context) {
    final pdm = ProjectDetailsViewModel.instance;
    return Column(
      children: [
        SizedBox(
          width: double.infinity,
          child: TextButton.icon(
            onPressed: () {
              pdm.tryDeleteProject(context);
            },
            label: Text(LocalKeys.deleteProject),
            style:
                ButtonStyle(foregroundColor: WidgetStateColor.resolveWith((s) {
              return dProvider.warningColor;
            })),
            icon: SvgAssets.trash.toSVGSized(24, color: dProvider.warningColor),
          ),
        ),
        SizedBox(
          height: 8,
        ),
        Builder(builder: (context) {
          final DateTime now = DateTime.now();
          if (!Provider.of<ModuleListService>(context, listen: false)
                  .promotionModule ||
              ((pd.projectDetailsModel.projectDetails?.isPro ?? false) &&
                  !now.isAfter(
                      pd.projectDetailsModel.projectDetails?.proExpireDate ??
                          now.subtract(Duration(days: 1)))) ||
              (pd.projectDetailsModel.projectDetails?.status.toString() ==
                  "0")) {
            return SizedBox();
          }
          return Container(
            width: double.infinity,
            padding: EdgeInsets.only(bottom: 8),
            child: OutlinedButton.icon(
              onPressed: () {
                PromotionPaymentViewModel.dispose;
                PromotionPaymentViewModel.instance.setType("project");
                PromotionPaymentViewModel.instance
                    .setId(pd.projectDetailsModel.projectDetails?.id);
                context.toPage(PromotionPaymentView());
              },
              label: Text("Promote"),
              icon: SvgAssets.crown.toSVGSized(24, color: dProvider.black5),
            ),
          );
        }),
        SizedBox(
          width: double.infinity,
          child: ElevatedButton.icon(
            onPressed: () async {
              final pdProvider =
                  Provider.of<ProjectDetailsService>(context, listen: false);
              if (pdProvider.projectDetailsModel.projectDetails != null) {
                CreateProjectViewModel.dispose;
                CreateProjectViewModel.instance.initProject(
                    pdProvider.projectDetailsModel.projectDetails!);
                context.toPage(const CreateProjectView());
              }
            },
            label: Text(LocalKeys.editProject),
            icon: SvgAssets.edit2.toSVGSized(24, color: dProvider.whiteColor),
          ),
        ),
      ],
    );
  }
}

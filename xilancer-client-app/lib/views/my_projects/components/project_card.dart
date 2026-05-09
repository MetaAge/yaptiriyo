import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/my_projects_service.dart';
import 'package:xilancer/services/project_details_service.dart';

import 'package:xilancer/view_models/promotion_payment_view_model/promotion_payment_view_model.dart';
import 'package:xilancer/views/promotion_payment_view/promotion_payment_view.dart';

import '../../../helper/svg_assets.dart';
import '../../../models/my_projects_model.dart';
import '../../../utils/components/image_pl_widget.dart';
import '../../../utils/components/pro_tag.dart';
import '../../../view_models/project_details_view_model/project_details_view_model.dart';
import '../../create_project_view_freelancer/create_project_view.dart';
import '../../../view_models/create_project_view_model/create_project_view_model.dart';
import '../../project_details_view/project_details_view.dart';

class ProjectCard extends StatelessWidget {
  final Project project;
  final String projectsPath;
  final bool pop;
  const ProjectCard(
      {super.key,
      required this.project,
      required this.projectsPath,
      this.pop = false});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        ProjectDetailsViewModel.dispose;
        Provider.of<ProjectDetailsService>(context, listen: false).reset();
        context.toNamed(
          ProjectDetailsView.routeName,
          arguments: [project.id],
        );
      },
      child: Container(
        padding: const EdgeInsets.all(16),
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(8),
          color: context.dProvider.whiteColor,
          border: (project.isPremium || project.isSubscriptionPromoted)
            ? Border.all(color: Colors.amber.withOpacity(0.5), width: 2)
            : null,
          boxShadow: (project.isPremium || project.isSubscriptionPromoted)
            ? [BoxShadow(color: Colors.amber.withOpacity(0.2), blurRadius: 10, spreadRadius: 2)]
            : null,
        ),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Stack(
              children: [
                SizedBox(
                  height: (context.width - 72) * 0.54237,
                  width: double.infinity,
                  child: ClipRRect(
                    borderRadius: BorderRadius.circular(8),
                    child: (() {
                      final imageUrl = (project.cloudImage ?? "").isNotEmpty
                          ? project.cloudImage!
                          : (project.image != null &&
                                  project.image!.toString().isNotEmpty)
                              ? "$projectsPath/${project.image}"
                              : "";
                      if (imageUrl.isEmpty) {
                        return Image.asset(
                          "assets/images/app_icon.png",
                          height: 60,
                          width: 60,
                          fit: BoxFit.contain,
                        );
                      }
                      return CachedNetworkImage(
                        fit: BoxFit.cover,
                        imageUrl: imageUrl,
                        placeholder: (context, url) =>
                            const ImagePLWidget(size: 60),
                        errorWidget: (context, url, error) => Image.asset(
                          "assets/images/app_icon.png",
                          height: 60,
                          width: 60,
                          fit: BoxFit.contain,
                        ),
                      );
                    }()),
                  ),
                ),
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    if (project.status.toString() == "0")
                      Container(
                        padding: const EdgeInsets.symmetric(
                            horizontal: 8, vertical: 2),
                        margin: const EdgeInsets.all(12),
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(20),
                          color: context.dProvider.yellowColor,
                        ),
                        child: Text(
                          LocalKeys.pending,
                          style: context.titleSmall
                              ?.copyWith(color: context.dProvider.whiteColor)
                              .bold6,
                        ),
                      ),
                    const Spacer(),
                    Container(
                      margin: const EdgeInsets.all(8),
                      decoration: BoxDecoration(
                        color: context.dProvider.whiteColor.withOpacity(0.8),
                        borderRadius: BorderRadius.circular(20),
                      ),
                      child: Switch(
                        value: project.projectOnOff == 1,
                        onChanged: (value) {
                          Provider.of<MyProjectsService>(context, listen: false)
                              .toggleStatus(project.id, context);
                        },
                        activeColor: context.dProvider.whiteColor,
                        activeTrackColor: context.dProvider.primaryColor,
                        inactiveTrackColor:
                            context.dProvider.hintColor.withOpacity(0.1),
                        inactiveThumbColor: context.dProvider.whiteColor,
                        trackOutlineColor:
                            WidgetStateProperty.all(Colors.transparent),
                      ),
                    ),
                  ],
                ),
                Positioned(
                  bottom: 10,
                  right: 10,
                  child: ProTag(
                    isPro: project.isPro || project.isSubscriptionPromoted || project.isPremium,
                    proExpDate: project.proExpDate,
                  ),
                )
              ],
            ),
            16.toHeight,
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(20),
                    color: context.dProvider.yellowColor.withOpacity(0.10),
                  ),
                  child: FittedBox(
                    child: Row(
                      children: [
                        if (project.ratingsCount > 0)
                          Icon(
                            Icons.star_rounded,
                            color: context.dProvider.yellowColor,
                            size: 20,
                          ),
                        Text(
                          project.ratingsCount > 0
                              ? "${project.ratingsAvgRating.toStringAsFixed(1)}(${project.ratingsCount})"
                              : LocalKeys.noReview,
                          style: context.titleSmall
                              ?.copyWith(color: context.dProvider.yellowColor)
                              .bold6,
                        )
                      ],
                    ),
                  ),
                ),
                Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(20),
                    color: context.dProvider.greenColor.withOpacity(.20),
                  ),
                  child: Text(
                    project.completeOrdersCount > 0
                        ? "${project.completeOrdersCount} ${LocalKeys.ordersCompleted}"
                        : LocalKeys.noOrder,
                    style: context.bodySmall
                        ?.copyWith(color: context.dProvider.greenColor)
                        .bold6,
                  ),
                ),
              ],
            ),
            8.toHeight,
            Text(
              project.title ?? "",
              style: context.titleMedium?.bold6,
              maxLines: 1,
              overflow: TextOverflow.ellipsis,
            ),
            8.toHeight,
            Row(
              children: [
                Expanded(
                  child: FittedBox(
                    alignment: Alignment.centerLeft,
                    fit: BoxFit.scaleDown,
                    child: RichText(
                        text: TextSpan(
                            text: LocalKeys.from == "Kimden"
                                ? ""
                                : "${LocalKeys.from}: ",
                            style: context.titleMedium
                                ?.copyWith(color: context.dProvider.black6)
                                .bold6,
                            children: [
                          TextSpan(
                            text:
                                "${(((project.basicDiscountCharge ?? 0) > 0 ? project.basicDiscountCharge! : project.basicRegularCharge)).toStringAsFixed(0).cur}",
                            style: context.titleMedium
                                ?.copyWith(
                                    color: context.dProvider.primaryColor)
                                .bold6,
                          ),
                          TextSpan(
                            text: LocalKeys.from == "Kimden"
                                ? "'dan başlayan "
                                : " ",
                            style: context.titleMedium
                                ?.copyWith(color: context.dProvider.black6)
                                .bold6,
                          ),
                          if ((project.basicDiscountCharge ?? 0) > 0)
                            TextSpan(
                              text:
                                  " ${(project.basicRegularCharge).toStringAsFixed(0).cur}",
                              style: context.titleSmall
                                  ?.copyWith(
                                      color: context.dProvider.black6,
                                      decoration: TextDecoration.lineThrough,
                                      decorationColor:
                                          context.dProvider.black6)
                                  .bold6,
                            ),
                        ])),
                  ),
                ),
                10.toWidth,
                Row(
                  mainAxisAlignment: MainAxisAlignment.end,
                  children: [
                    // Subscription Promote Button
                    if (!project.isPremium)
                      IconButton(
                        onPressed: () {
                          Provider.of<MyProjectsService>(context, listen: false)
                              .toggleSubscriptionPromotion(project.id, context);
                        },
                        icon: Icon(
                          project.isSubscriptionPromoted 
                            ? Icons.verified_rounded 
                            : Icons.verified_outlined,
                          color: project.isSubscriptionPromoted 
                            ? Colors.amber 
                            : context.dProvider.hintColor,
                          size: 24,
                        ),
                        tooltip: "Abonelik ile Öne Çıkar",
                      ),
                    if (!project.isPremium && !project.isSubscriptionPromoted && !(project.isPro && (project.proExpDate?.isAfter(DateTime.now()) ?? false)))
                      IconButton(
                        onPressed: () {
                          final ppm = PromotionPaymentViewModel.instance;
                          ppm.setId(project.id);
                          ppm.setType("project");
                          context.toNamed(PromotionPaymentView.routeName);
                        },
                        icon: Icon(
                          Icons.rocket_launch_rounded,
                          color: context.dProvider.yellowColor,
                          size: 24,
                        ),
                        tooltip: LocalKeys.promoteNow,
                      ),
                    IconButton(
                      onPressed: () async {
                        await Provider.of<ProjectDetailsService>(context,
                                listen: false)
                            .fetchOrderDetails(projectId: project.id);
                        final details =
                            Provider.of<ProjectDetailsService>(context,
                                    listen: false)
                                .projectDetailsModel[project.id.toString()]
                                ?.projectDetails;
                        if (details != null) {
                          CreateProjectViewModel.dispose;
                          CreateProjectViewModel.instance.initProject(details);
                          context.toNamed(CreateProjectView.routeName);
                        }
                      },
                      icon: SvgAssets.edit.toSVGSized(28,
                          color: context.dProvider.primaryColor),
                    ),
                    IconButton(
                      onPressed: () {
                        Provider.of<MyProjectsService>(context, listen: false)
                            .deleteProject(project.id, context);
                      },
                      icon: SvgAssets.trash.toSVGSized(20,
                          color: context.dProvider.warningColor),
                    ),
                  ],
                )
              ],
            ),
          ],
        ),
      ),
    );
  }
}

import 'dart:ui';

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/utils/components/custom_future_widget.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'components/project_share_modal.dart';
import 'package:xilancer/utils/components/success_overlay.dart';
import 'package:xilancer/views/project_details_view/components/project_details_basic_info.dart';
import 'package:xilancer/views/project_details_view/components/project_details_package.dart';
import 'package:xilancer/views/project_details_view/components/project_details_package_charges.dart';

import '../../helper/svg_assets.dart';
import '../../models/project_list_model.dart';
import '../../services/bookmark_data_service.dart';
import '../../services/project_details_service.dart';
import 'components/freelancer_info.dart';
import 'components/project_details_skeleton.dart';
import 'components/project_image_gallery.dart';
import '../../customizations.dart' as cus;

class ProjectDetailsView extends StatelessWidget {
  static const routeName = 'project_details_view';
  const ProjectDetailsView({super.key});
  @override
  Widget build(BuildContext context) {
    final List routeData =
        (ModalRoute.of(context)?.settings.arguments ?? []) as List;
    final id = routeData[0];
    final bool isPublic = routeData.length > 1 ? routeData[1] : false;
    return Scaffold(
        body: Consumer<ProjectDetailsService>(builder: (context, pd, child) {
          final project = pd.projectDetailsModel[id.toString()];
          final projectDetails = project?.projectDetails;

          return Stack(
            children: [
              CustomFutureWidget(
                function: pd.shouldAutoFetch(id)
                    ? pd.fetchOrderDetails(projectId: id, isPublic: isPublic)
                    : null,
                shimmer: const ProjectDetailsSkeleton(),
                child: CustomScrollView(
                  slivers: [
                    SliverAppBar(
                      expandedHeight: 250.0,
                      floating: false,
                      pinned: true,
                      leading: Padding(
                        padding: const EdgeInsets.all(12.0),
                        child: ClipRRect(
                          borderRadius: BorderRadius.circular(12),
                          child: BackdropFilter(
                            filter: ColorFilter.mode(
                                Colors.white.withOpacity(0.2), BlendMode.overlay),
                            child: Container(
                              decoration: BoxDecoration(
                                color: Colors.white24,
                                borderRadius: BorderRadius.circular(12),
                                border: Border.all(color: Colors.white30, width: 0.5),
                              ),
                              child: const NavigationPopIcon(
                                hideContainer: true,
                              ),
                            ),
                          ),
                        ),
                      ),
                      actions: [
                        Consumer<BookmarkDataService>(
                            builder: (context, bd, child) {
                          final isBookmarked =
                              bd.isBookmarked(id.toString().toString());
                          return Padding(
                            padding: const EdgeInsets.only(right: 16),
                            child: Row(
                              children: [
                                GestureDetector(
                                  onTap: () {
                                    if (projectDetails == null) return;
                                    ProjectShareModal.show(
                                      context,
                                      title: projectDetails.title ?? "",
                                      imageUrl: projectDetails.firstImage != null
                                          ? "${cus.projectImagePath}/${projectDetails.firstImage}"
                                          : "",
                                      price: projectDetails.basicRegularCharge.toStringAsFixed(0).cur,
                                      link: "${cus.siteLink}/service/${projectDetails.id}",
                                    );
                                  },
                                  child: Center(
                                    child: ClipRRect(
                                      borderRadius: BorderRadius.circular(12),
                                      child: BackdropFilter(
                                        filter: ColorFilter.mode(
                                            Colors.white.withOpacity(0.2), BlendMode.overlay),
                                        child: Container(
                                          height: 40,
                                          width: 40,
                                          decoration: BoxDecoration(
                                            color: Colors.white24,
                                            borderRadius: BorderRadius.circular(12),
                                            border: Border.all(color: Colors.white30, width: 0.5),
                                          ),
                                          child: const Icon(Icons.share_rounded, size: 20, color: Colors.white),
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                                const SizedBox(width: 12),
                                GestureDetector(
                                  onTap: () {
                                    if (projectDetails == null) return;
                                    final proj = Project(
                                      id: projectDetails.id,
                                      basicRegularCharge:
                                          projectDetails.basicRegularCharge,
                                      basicDiscountCharge:
                                          projectDetails.basicDiscountCharge,
                                      basicDelivery: projectDetails.basicDelivery,
                                      image: projectDetails.firstImage,
                                      ratingCount: projectDetails.ratingCount,
                                      avgRating: project?.projectRating ?? 0,
                                      completeOrdersCount:
                                          projectDetails.completeOrdersCount,
                                      title: projectDetails.title,
                                      projectCreator: projectDetails.projectCreator == null
                                          ? null
                                          : ProjectCreator.fromJson(
                                              projectDetails.projectCreator!.toJson()),
                                      proExpDate: projectDetails.proExpDate,
                                      isPro: projectDetails.isPro,
                                    );
                                    final data = proj.toJson();
                                    bd.toggleBookmark(proj.id.toString(), data);
                                    SuccessOverlay.show(
                                      context, 
                                      isBookmarked ? "Favorilerden Çıkarıldı" : "Favorilere Eklendi"
                                    );
                                  },
                                  child: Center(
                                    child: ClipRRect(
                                      borderRadius: BorderRadius.circular(12),
                                      child: BackdropFilter(
                                        filter: ColorFilter.mode(
                                            Colors.white.withOpacity(0.2), BlendMode.overlay),
                                        child: Container(
                                          height: 40,
                                          width: 40,
                                          decoration: BoxDecoration(
                                            color: Colors.white24,
                                            borderRadius: BorderRadius.circular(12),
                                            border: Border.all(color: Colors.white30, width: 0.5),
                                          ),
                                          child: (isBookmarked
                                                  ? SvgAssets.bookmarkSub
                                                  : SvgAssets.bookmarkAdd)
                                              .toSVGSized(20,
                                                  color: isBookmarked
                                                      ? context.dProvider.primaryColor
                                                      : Colors.white),
                                        ),
                                      ),
                                    ),
                                  ),
                                ),
                              ],
                            ),
                          );
                        }),
                      ],
                      flexibleSpace: FlexibleSpaceBar(
                        background: Stack(
                          fit: StackFit.expand,
                          children: [
                            if (projectDetails != null)
                              ProjectImageGallery(
                                projectDetails: projectDetails,
                                projectFilePath:
                                    project?.projectFilePath.toString() ?? "",
                              )
                            else
                              Container(color: context.dProvider.black9),
                            const IgnorePointer(
                              child: DecoratedBox(
                                decoration: BoxDecoration(
                                  gradient: LinearGradient(
                                    begin: Alignment.topCenter,
                                    end: Alignment.bottomCenter,
                                    colors: [
                                      Colors.black45,
                                      Colors.transparent,
                                      Colors.black26,
                                    ],
                                  ),
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ),
                    SliverList(
                      delegate: SliverChildListDelegate([
                        ProjectDetailsBasicInfo(
                          showEdit: routeData.isEmpty,
                          projectId: id,
                        ),
                        FreelancerInfo(
                          projectId: id,
                        ),
                        20.toHeight,
                        ProjectDetailsPackages(
                          projectId: id,
                        ),
                        120.toHeight, // Spacer for fixed footer
                      ]),
                    ),
                  ],
                ),
              ),
              // Fixed Glassmorphism Footer
              if (project != null)
                Positioned(
                  bottom: 0,
                  left: 0,
                  right: 0,
                  child: ClipRRect(
                    borderRadius: const BorderRadius.vertical(top: Radius.circular(32)),
                    child: BackdropFilter(
                      filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),
                      child: Container(
                        padding: const EdgeInsets.only(bottom: 30, top: 20, left: 16, right: 16),
                        decoration: BoxDecoration(
                          color: context.dProvider.whiteColor.withOpacity(0.85),
                          borderRadius: const BorderRadius.vertical(top: Radius.circular(32)),
                          border: Border.all(color: Colors.white.withOpacity(0.3)),
                          boxShadow: [
                            BoxShadow(
                              color: Colors.black.withOpacity(0.08),
                              blurRadius: 20,
                              offset: const Offset(0, -5),
                            ),
                          ],
                        ),
                        child: SafeArea(
                          top: false,
                          child: ProjectDetailsPackageChanges(
                            regularCharge: "0",
                            discountCharge: 0,
                            projectId: id,
                          ),
                        ),
                      ),
                    ),
                  ),
                ),
            ],
          );
        }));
  }
}

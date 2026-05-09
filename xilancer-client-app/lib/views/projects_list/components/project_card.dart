import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/project_details_service.dart';
import 'package:xilancer/utils/components/image_pl_widget.dart';
import 'package:xilancer/view_models/project_details_view_model/project_details_view_model.dart';
import 'package:xilancer/views/project_details_view/components/pro_tag.dart';

import '../../../helper/svg_assets.dart';
import '../../../models/project_list_model.dart';
import '../../../services/bookmark_data_service.dart';
import '../../project_details_view/project_details_view.dart';
import '../../../customizations.dart' as cus;
import 'package:xilancer/utils/components/success_overlay.dart';

class ProjectCard extends StatelessWidget {
  final Project project;
  final String projectsPath;
  final bool pop;
  final bool fromProfile;
  const ProjectCard(
      {super.key,
      required this.project,
      required this.projectsPath,
      this.pop = false,
      this.fromProfile = false});

  @override
  Widget build(BuildContext context) {
    final effectivePrice = ((project.basicDiscountCharge ?? 0) > 0) 
        ? (project.basicDiscountCharge ?? 0) 
        : project.basicRegularCharge;
    final hasDiscount = (project.basicDiscountCharge ?? 0) > 0;

    return GestureDetector(
      onTap: () {
        ProjectDetailsViewModel.dispose;
        context.toNamed(ProjectDetailsView.routeName, arguments: [project.id, true],
            then: () {
          Provider.of<ProjectDetailsService>(context, listen: false)
              .removeProject(id: project.id);
        });
      },
      child: Container(
        margin: const EdgeInsets.only(bottom: 20),
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(20),
          color: context.dProvider.whiteColor,
          border: project.isPremium 
              ? Border.all(color: Colors.amber.withOpacity(0.5), width: 1.5)
              : Border.all(color: context.dProvider.black9.withOpacity(0.08)),
          boxShadow: [
            BoxShadow(
              color: project.isPremium 
                  ? Colors.amber.withOpacity(0.15) 
                  : Colors.black.withOpacity(0.05),
              blurRadius: project.isPremium ? 30 : 20,
              offset: const Offset(0, 8),
            ),
          ],
        ),

        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Image Area with Overlays
            Stack(
              children: [
                Hero(
                  tag: "project-image-${project.id}",
                  child: Container(
                    height: 160,
                    width: double.infinity,
                    decoration: BoxDecoration(
                      borderRadius: const BorderRadius.vertical(top: Radius.circular(20)),
                      color: context.dProvider.black8,
                    ),
                    child: ClipRRect(
                      borderRadius: const BorderRadius.vertical(top: Radius.circular(20)),
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
                              height: 40,
                              width: 40,
                              fit: BoxFit.contain,
                            );
                          }
                          return CachedNetworkImage(
                            fit: BoxFit.cover,
                            imageUrl: imageUrl,
                            placeholder: (context, url) => Center(
                              child: Image.asset("assets/images/app_icon.png",
                                  height: 40, width: 40, fit: BoxFit.contain),
                            ),
                            errorWidget: (context, url, error) => Center(
                              child: Image.asset("assets/images/app_icon.png",
                                  height: 40, width: 40, fit: BoxFit.contain),
                            ),
                          );
                        }()),
                    ),
                  ),
                ),
                
                // Badges Overlay (Top)
                Positioned(
                  top: 12,
                  left: 12,
                  right: 12,
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      if (project.isPro) 
                        ProTag(
                          isPro: project.isPro, 
                          proExpDate: project.proExpDate,
                          isSubscription: project.isSubscriptionPromoted || project.isPremium,
                        ),
                      if (project.isPro && project.isPremium) const SizedBox(width: 8),
                      if (project.isPremium)
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
                          decoration: BoxDecoration(
                            gradient: const LinearGradient(
                              colors: [Color(0xFFFFD700), Color(0xFFFFA500)],
                            ),
                            borderRadius: BorderRadius.circular(10),
                            boxShadow: [
                              BoxShadow(color: Colors.black.withOpacity(0.1), blurRadius: 4)
                            ],
                          ),
                          child: const Row(
                            children: [
                              Icon(Icons.verified_rounded, color: Colors.white, size: 12),
                              SizedBox(width: 4),
                              Text(
                                "PREMIUM",
                                style: TextStyle(
                                  color: Colors.white,
                                  fontSize: 10,
                                  fontWeight: FontWeight.bold,
                                  letterSpacing: 0.5,
                                ),
                              ),
                            ],
                          ),
                        ),
                      const Spacer(),

                      Consumer<BookmarkDataService>(builder: (context, bd, child) {
                        final isBookmarked = bd.isBookmarked(project.id.toString());
                        return GestureDetector(
                          onTap: () {
                            bd.toggleBookmark(project.id.toString(), project.toJson());
                            SuccessOverlay.show(
                              context, 
                              isBookmarked ? "Favorilerden Çıkarıldı" : "Favorilere Eklendi"
                            );
                          },
                          child: Container(
                            padding: const EdgeInsets.all(8),
                            decoration: BoxDecoration(
                              shape: BoxShape.circle,
                              color: isBookmarked ? context.dProvider.primaryColor : Colors.black.withOpacity(0.3),
                            ),
                            child: Icon(
                              isBookmarked ? Icons.bookmark_rounded : Icons.bookmark_outline_rounded,
                              size: 20,
                              color: Colors.white,
                            ),
                          ),
                        );
                      }),
                    ],
                  ),
                ),

                // Price Badge (Bottom Right Overlay)
                Positioned(
                  bottom: 12,
                  right: 12,
                  child: Container(
                    padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 8),
                    decoration: BoxDecoration(
                      color: Colors.white,
                      borderRadius: BorderRadius.circular(16),
                      boxShadow: [
                        BoxShadow(color: Colors.black.withOpacity(0.1), blurRadius: 10)
                      ],
                    ),
                    child: Row(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        if (hasDiscount)
                          Padding(
                            padding: const EdgeInsets.only(right: 6),
                            child: Text(
                              project.basicRegularCharge.toStringAsFixed(0).cur,
                              style: TextStyle(
                                fontSize: 11,
                                color: context.dProvider.black5,
                                decoration: TextDecoration.lineThrough,
                              ),
                            ),
                          ),
                        Text(
                          effectivePrice.toStringAsFixed(0).cur,
                          style: TextStyle(
                            fontSize: 16,
                            fontWeight: FontWeight.bold,
                            color: context.dProvider.primaryColor,
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ],
            ),

            Padding(
              padding: const EdgeInsets.all(16),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Meta Info Row
                  Row(
                    children: [
                      _infoPill(
                        context, 
                        icon: Icons.star_rounded, 
                        label: project.ratingCount > 0 
                            ? project.avgRating?.toStringAsFixed(1) ?? "0" 
                            : LocalKeys.noReview,
                        color: Colors.amber,
                      ),
                      const SizedBox(width: 8),
                      _infoPill(
                        context, 
                        icon: Icons.shopping_bag_rounded, 
                        label: project.completeOrdersCount > 0 
                            ? "${project.completeOrdersCount} Sipariş" 
                            : "Yeni",
                        color: Colors.green,
                      ),
                      const Spacer(),
                      Row(
                        children: [
                          Icon(Icons.access_time_rounded, size: 14, color: context.dProvider.black5),
                          const SizedBox(width: 4),
                          Text(
                            (project.basicDelivery ?? "")
                                .replaceAll("Days", "Gün")
                                .replaceAll("Day", "Gün")
                                .replaceAll("Hours", "Saat")
                                .replaceAll("Hour", "Saat")
                                .replaceAll("Minutes", "Dakika")
                                .replaceAll("Minute", "Dakika"),
                            style: context.bodySmall?.copyWith(fontSize: 11, color: context.dProvider.black5),
                          ),
                        ],
                      ),
                    ],
                  ),
                  
                  const SizedBox(height: 12),
                  
                  // Title
                  Text(
                    project.title ?? "",
                    maxLines: 2,
                    overflow: TextOverflow.ellipsis,
                    style: context.titleMedium?.copyWith(
                      fontWeight: FontWeight.bold,
                      height: 1.3,
                      color: context.dProvider.black2,
                    ),
                  ),
                  
                  const SizedBox(height: 16),
                  const Divider(height: 1, thickness: 0.5),
                  const SizedBox(height: 16),

                  // Freelancer Info Row
                  Row(
                    children: [
                      Container(
                        height: 32,
                        width: 32,
                        decoration: BoxDecoration(
                          shape: BoxShape.circle,
                          color: context.dProvider.black8,
                          image: project.projectCreator?.image != null 
                            ? DecorationImage(
                                image: NetworkImage("${cus.userProfilePath}/${project.projectCreator!.image}"),
                                fit: BoxFit.cover,
                              )
                            : null,
                        ),
                        child: project.projectCreator?.image == null 
                          ? const Icon(Icons.person, size: 18, color: Colors.grey)
                          : null,
                      ),
                      const SizedBox(width: 10),
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Row(
                              children: [
                                Text(
                                  "${project.projectCreator?.firstName ?? "İsimsiz"} ${project.projectCreator?.lastName ?? ""}".trim(),
                                  style: context.bodySmall?.copyWith(
                                    fontWeight: FontWeight.bold,
                                    color: context.dProvider.black3,
                                  ),
                                ),
                                if ((project.projectCreator?.avgRating ?? 0) > 0) ...[
                                  const SizedBox(width: 6),
                                  Icon(Icons.star_rounded, size: 12, color: Colors.amber),
                                  const SizedBox(width: 2),
                                  Text(
                                    project.projectCreator!.avgRating!.toStringAsFixed(1),
                                    style: context.bodySmall?.copyWith(
                                      fontSize: 10,
                                      fontWeight: FontWeight.bold,
                                      color: Colors.amber[700],
                                    ),
                                  ),
                                ],
                              ],
                            ),
                            Text(
                              project.projectCreator?.experienceLevel ?? "Uzman",
                              style: context.bodySmall?.copyWith(
                                fontSize: 10,
                                color: context.dProvider.black5,
                              ),
                            ),
                          ],
                        ),
                      ),
                      Icon(Icons.chevron_right_rounded, color: context.dProvider.black7),
                    ],
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _infoPill(BuildContext context, {required IconData icon, required String label, required Color color}) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 6),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        borderRadius: BorderRadius.circular(12),
      ),
      child: Row(
        mainAxisSize: MainAxisSize.min,
        children: [
          Icon(icon, size: 14, color: color),
          const SizedBox(width: 4),
          Text(
            label,
            style: TextStyle(
              fontSize: 12,
              fontWeight: FontWeight.bold,
              color: color,
            ),
          ),
        ],
      ),
    );
  }
}

import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/models/project_list_model.dart';
import 'package:xilancer/services/project_details_service.dart';
import 'package:xilancer/view_models/project_details_view_model/project_details_view_model.dart';
import 'package:xilancer/views/project_details_view/project_details_view.dart';
import '../../../customizations.dart' as cus;
import 'package:xilancer/services/bookmark_data_service.dart';
import 'package:xilancer/utils/components/success_overlay.dart';

class ProjectCardSmall extends StatelessWidget {
  final Project project;
  final String projectsPath;
  final double? width;

  const ProjectCardSmall({
    super.key,
    required this.project,
    required this.projectsPath,
    this.width,
  });

  @override
  Widget build(BuildContext context) {
    final effectivePrice = ((project.basicDiscountCharge ?? 0) > 0)
        ? (project.basicDiscountCharge ?? 0)
        : project.basicRegularCharge;

    return GestureDetector(
      onTap: () {
        HapticFeedback.lightImpact();
        ProjectDetailsViewModel.dispose;
        context.toNamed(ProjectDetailsView.routeName, arguments: [project.id, true],
            then: () {
          Provider.of<ProjectDetailsService>(context, listen: false)
              .removeProject(id: project.id);
        });
      },
      child: Container(
        width: width ?? 160,
        margin: const EdgeInsets.only(right: 16),
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
              blurRadius: project.isPremium ? 15 : 10,
              offset: const Offset(0, 4),
            ),
          ],
        ),

        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Image Area
            SizedBox(
              height: 130,
              child: Stack(
                children: [
                  ClipRRect(
                    borderRadius: const BorderRadius.vertical(top: Radius.circular(20)),
                    child: Container(
                      height: double.infinity,
                      width: double.infinity,
                      color: context.dProvider.black8,
                      child: (() {
                        final imageUrl = (project.cloudImage ?? "").isNotEmpty
                            ? project.cloudImage!
                            : (project.image != null &&
                                    project.image!.toString().isNotEmpty)
                                ? "$projectsPath/${project.image}"
                                : "";
                        if (imageUrl.isEmpty) {
                          return const Icon(Icons.image, color: Colors.grey);
                        }
                        return CachedNetworkImage(
                          fit: BoxFit.cover,
                          imageUrl: imageUrl,
                        );
                      }()),
                    ),
                  ),
                  if (project.isPro || project.isPremium)
                    Positioned(
                      top: 8,
                      left: 8,
                      child: Row(
                        children: [
                          if (project.isPro)
                            Container(
                              padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                              decoration: BoxDecoration(
                                color: context.dProvider.primaryColor,
                                borderRadius: BorderRadius.circular(8),
                              ),
                              child: const Text(
                                "ÖNE ÇIKAN",
                                style: TextStyle(
                                  color: Colors.white,
                                  fontSize: 8,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ),
                          if (project.isPro && project.isPremium) const SizedBox(width: 4),
                          if (project.isPremium)
                            Container(
                              padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                              decoration: BoxDecoration(
                                gradient: const LinearGradient(
                                  colors: [Color(0xFFFFD700), Color(0xFFFFA500)],
                                ),
                                borderRadius: BorderRadius.circular(8),
                              ),
                              child: const Text(
                                "PREMIUM",
                                style: TextStyle(
                                  color: Colors.white,
                                  fontSize: 8,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ),
                        ],
                      ),
                    ),

                  Positioned(
                    top: 8,
                    right: 8,
                    child: Consumer<BookmarkDataService>(builder: (context, bd, child) {
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
                          padding: const EdgeInsets.all(6),
                          decoration: BoxDecoration(
                            shape: BoxShape.circle,
                            color: isBookmarked ? context.dProvider.primaryColor : Colors.black.withOpacity(0.3),
                          ),
                          child: Icon(
                            isBookmarked ? Icons.bookmark_rounded : Icons.bookmark_outline_rounded,
                            size: 16,
                            color: Colors.white,
                          ),
                        ),
                      );
                    }),
                  ),
                ],
              ),
            ),
            Padding(
              padding: const EdgeInsets.all(12),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  SizedBox(
                    height: 36,
                    child: Text(
                      project.title ?? "",
                      maxLines: 2,
                      overflow: TextOverflow.ellipsis,
                      style: context.bodySmall?.copyWith(
                        fontWeight: FontWeight.w600,
                        fontSize: 13,
                        height: 1.2,
                        color: context.dProvider.black2,
                      ),
                    ),
                  ),
                  const SizedBox(height: 10),
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Container(
                        padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                        decoration: BoxDecoration(
                          color: context.dProvider.primaryColor.withOpacity(0.15),
                          borderRadius: BorderRadius.circular(6),
                        ),
                        child: Text(
                          effectivePrice.toStringAsFixed(0).cur,
                          style: TextStyle(
                            fontSize: 12,
                            fontWeight: FontWeight.bold,
                            color: context.dProvider.primaryColor,
                          ),
                        ),
                      ),
                      Row(
                        children: [
                          const Icon(Icons.star_rounded, size: 14, color: Colors.amber),
                          const SizedBox(width: 2),
                          Text(
                            project.avgRating?.toStringAsFixed(1) ?? "0",
                            style: context.bodySmall?.copyWith(
                              fontSize: 11,
                              fontWeight: FontWeight.bold,
                              color: context.dProvider.black3,
                            ),
                          ),
                        ],
                      ),
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
}

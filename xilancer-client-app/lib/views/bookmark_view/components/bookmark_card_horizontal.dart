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

class BookmarkCardHorizontal extends StatelessWidget {
  final Project project;
  final String projectsPath;

  const BookmarkCardHorizontal({
    super.key,
    required this.project,
    required this.projectsPath,
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
        height: 140,
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(16),
          color: context.dProvider.whiteColor,
          border: Border.all(color: context.dProvider.black9.withOpacity(0.08)),
          boxShadow: [
            BoxShadow(
              color: Colors.black.withOpacity(0.03),
              blurRadius: 10,
              offset: const Offset(0, 4),
            ),
          ],
        ),
        child: Row(
          children: [
            // Image Section
            Stack(
              children: [
                ClipRRect(
                  borderRadius: const BorderRadius.horizontal(left: Radius.circular(16)),
                  child: Container(
                    width: 120,
                    height: 140,
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
                if (project.isPro)
                  Positioned(
                    top: 8,
                    left: 8,
                    child: Container(
                      padding: const EdgeInsets.symmetric(horizontal: 6, vertical: 3),
                      decoration: BoxDecoration(
                        color: context.dProvider.primaryColor,
                        borderRadius: BorderRadius.circular(6),
                      ),
                      child: const Text(
                        "SPONSORLU",
                        style: TextStyle(color: Colors.white, fontSize: 7, fontWeight: FontWeight.bold),
                      ),
                    ),
                  ),
              ],
            ),
            
            // Details Section
            Expanded(
              child: Padding(
                padding: const EdgeInsets.all(12),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Expanded(
                          child: Text(
                            project.title ?? "",
                            maxLines: 2,
                            overflow: TextOverflow.ellipsis,
                            style: context.bodyMedium?.bold6.copyWith(fontSize: 14),
                          ),
                        ),
                        Consumer<BookmarkDataService>(builder: (context, bd, child) {
                          return GestureDetector(
                            onTap: () {
                              bd.toggleBookmark(project.id.toString(), project.toJson());
                              SuccessOverlay.show(context, "Favorilerden Çıkarıldı");
                            },
                            child: Icon(
                              Icons.favorite_rounded,
                              size: 20,
                              color: context.dProvider.primaryColor,
                            ),
                          );
                        }),
                      ],
                    ),
                    const Spacer(),
                    Row(
                      children: [
                        Icon(Icons.star_rounded, size: 14, color: Colors.amber[700]),
                        const SizedBox(width: 4),
                        Text(
                          project.avgRating?.toStringAsFixed(1) ?? "0.0",
                          style: context.bodySmall?.bold6,
                        ),
                        const SizedBox(width: 8),
                      ],
                    ),
                    const SizedBox(height: 8),
                    Row(
                      mainAxisAlignment: MainAxisAlignment.spaceBetween,
                      crossAxisAlignment: CrossAxisAlignment.end,
                      children: [
                        Text(
                          effectivePrice.toStringAsFixed(0).cur,
                          style: context.titleMedium?.bold7.copyWith(
                            color: context.dProvider.primaryColor,
                            fontSize: 18,
                          ),
                        ),
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                          decoration: BoxDecoration(
                            color: context.dProvider.black9,
                            borderRadius: BorderRadius.circular(8),
                            border: Border.all(color: context.dProvider.black8),
                          ),
                          child: Text(
                            "Detaylar",
                            style: context.bodySmall?.bold6.copyWith(fontSize: 11),
                          ),
                        ),
                      ],
                    ),
                  ],
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

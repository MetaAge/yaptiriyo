import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/widget_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/models/profile_details_model.dart';
import 'package:xilancer/utils/components/image_pl_widget.dart';
import 'package:xilancer/views/profile_details_view/components/portfolio_full_screen_image.dart';

class PortfolioDetailBottomSheet extends StatelessWidget {
  final Portfolio portfolio;
  final String path;

  const PortfolioDetailBottomSheet({
    super.key,
    required this.portfolio,
    required this.path,
  });

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: const BorderRadius.only(
          topLeft: Radius.circular(20),
          topRight: Radius.circular(20),
        ),
      ),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          // Handle bar
          Container(
            margin: const EdgeInsets.symmetric(vertical: 12),
            height: 4,
            width: 40,
            decoration: BoxDecoration(
              color: context.dProvider.black8,
              borderRadius: BorderRadius.circular(2),
            ),
          ),

          Flexible(
            child: SingleChildScrollView(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Enlarged Zoomable Image
                  AspectRatio(
                    aspectRatio: 16 / 9,
                    child: GestureDetector(
                      onTap: () {
                        final imageUrl = portfolio.cloudImage ?? "$path/${portfolio.image}";
                        Navigator.push(
                          context,
                          MaterialPageRoute(
                            builder: (context) => PortfolioFullScreenImage(
                              imageUrl: imageUrl,
                              heroTag: "portfolio_${portfolio.id}",
                            ),
                          ),
                        );
                      },
                      child: Hero(
                        tag: "portfolio_${portfolio.id}",
                        child: InteractiveViewer(
                          clipBehavior: Clip.none,
                          maxScale: 5.0,
                          child: CachedNetworkImage(
                            imageUrl: portfolio.cloudImage ?? "$path/${portfolio.image}",
                            fit: BoxFit.contain,
                            placeholder: (context, url) => const ImagePLWidget(size: double.infinity),
                            errorWidget: (context, url, error) => const ImagePLWidget(size: double.infinity),
                          ),
                        ),
                      ),
                    ),
                  ).hp20,

                  const SizedBox(height: 20),

                  // Content
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 20),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          portfolio.title ?? "",
                          style: context.titleLarge?.bold6,
                        ),
                        const SizedBox(height: 8),
                        Text(
                          "${LocalKeys.published}: ${DateFormat("MMM dd, yyyy", context.dProvider.languageSlug).format(portfolio.createdAt ?? DateTime.now())}",
                          style: context.titleSmall?.copyWith(
                            color: context.dProvider.black5,
                          ),
                        ),
                        const Divider(height: 32),
                        Text(
                          LocalKeys.description,
                          style: context.titleMedium?.bold6,
                        ),
                        const SizedBox(height: 8),
                        Text(
                          portfolio.description ?? "",
                          style: context.titleMedium?.copyWith(
                            color: context.dProvider.black3,
                            height: 1.5,
                          ),
                        ),
                        const SizedBox(height: 40), // Bottom padding
                      ],
                    ),
                  ),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }
}

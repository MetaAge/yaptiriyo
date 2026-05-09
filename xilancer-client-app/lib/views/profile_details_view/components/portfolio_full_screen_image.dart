import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';

class PortfolioFullScreenImage extends StatelessWidget {
  final String imageUrl;
  final String heroTag;

  const PortfolioFullScreenImage({
    super.key,
    required this.imageUrl,
    required this.heroTag,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: context.dProvider.blackColor,
      body: Stack(
        children: [
          // Zoomable Image
          Center(
            child: Hero(
              tag: heroTag,
              child: InteractiveViewer(
                minScale: 0.5,
                maxScale: 10.0,
                child: CachedNetworkImage(
                  imageUrl: imageUrl,
                  fit: BoxFit.contain,
                  placeholder: (context, url) => const Center(
                    child: CircularProgressIndicator(),
                  ),
                ),
              ),
            ),
          ),

          // Close Icon
          Positioned(
            top: MediaQuery.of(context).padding.top + 10,
            left: 20,
            child: const NavigationPopIcon(),
          ),
        ],
      ),
    );
  }
}

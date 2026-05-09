import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import '../../../models/project_details_model.dart';
import '../../../utils/components/custom_network_image.dart';

class ProjectImageGallery extends StatefulWidget {
  final ProjectDetails projectDetails;
  final String projectFilePath;
  const ProjectImageGallery({
    super.key,
    required this.projectDetails,
    required this.projectFilePath,
  });

  @override
  State<ProjectImageGallery> createState() => _ProjectImageGalleryState();
}

class _ProjectImageGalleryState extends State<ProjectImageGallery> {
  final PageController _controller = PageController();
  int _currentIndex = 0;

  @override
  Widget build(BuildContext context) {
    final images = widget.projectDetails.allImageUrls(widget.projectFilePath);
    if (images.isEmpty) {
      return Center(
        child: Image.asset(
          "assets/images/app_icon.png",
          height: 100,
          width: 100,
          fit: BoxFit.contain,
        ),
      );
    }

    return Stack(
      fit: StackFit.expand,
      children: [
        PageView.builder(
          controller: _controller,
          physics: const BouncingScrollPhysics(),
          onPageChanged: (index) {
            setState(() {
              _currentIndex = index;
            });
          },
          itemCount: images.length,
          itemBuilder: (context, index) {
            return CustomNetworkImage(
              imageUrl: images[index],
              height: double.infinity,
              width: double.infinity,
              fit: BoxFit.cover,
            );
          },
        ),
        if (images.length > 1)
          Positioned(
            bottom: 12,
            left: 0,
            right: 0,
            child: IgnorePointer(
              child: Row(
                mainAxisAlignment: MainAxisAlignment.center,
                children: List.generate(
                  images.length,
                  (index) => Container(
                    margin: const EdgeInsets.symmetric(horizontal: 4),
                    width: _currentIndex == index ? 20 : 8,
                    height: 8,
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(4),
                      color: _currentIndex == index
                          ? context.dProvider.primaryColor
                          : Colors.white.withOpacity(0.5),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withOpacity(0.1),
                          blurRadius: 4,
                          offset: const Offset(0, 2),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
      ],
    );
  }
}

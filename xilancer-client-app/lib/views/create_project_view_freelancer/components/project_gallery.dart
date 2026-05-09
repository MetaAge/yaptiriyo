import 'dart:io';

import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/widget_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/view_models/create_project_view_model/create_project_view_model.dart';

import '../../../customizations.dart';
import '../../../utils/components/image_pl_widget.dart';
import '../../../utils/components/field_with_label.dart';
import 'create_project_buttons.dart';

class ProjectGallery extends StatelessWidget {
  const ProjectGallery({super.key});

  @override
  Widget build(BuildContext context) {
    final cpm = CreateProjectViewModel.instance;
    return SingleChildScrollView(
      child: Column(
        children: [
          Container(
            margin: const EdgeInsets.all(20),
            padding: const EdgeInsets.symmetric(vertical: 24),
            decoration: BoxDecoration(
              borderRadius: BorderRadius.circular(24),
              color: context.dProvider.whiteColor,
              border: Border.all(color: context.dProvider.black8.withOpacity(0.5)),
              boxShadow: [
                BoxShadow(
                  color: Colors.black.withOpacity(0.04),
                  blurRadius: 20,
                  offset: const Offset(0, 10),
                ),
              ],
            ),
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  LocalKeys.projectGalleryUpload,
                  style: context.titleMedium?.copyWith(
                    fontWeight: FontWeight.bold,
                    color: context.dProvider.black2,
                  ),
                ).hp20,
                const SizedBox(height: 16),
                Divider(
                  color: context.dProvider.black8,
                  thickness: 1,
                  height: 1,
                ),
                const SizedBox(height: 24),
                ValueListenableBuilder(
                    valueListenable: cpm.projectImage,
                    builder: (context, images, child) {
                      return Padding(
                        padding: const EdgeInsets.symmetric(horizontal: 20),
                        child: Wrap(
                          spacing: 16,
                          runSpacing: 16,
                          children: [
                            ...cpm.oldImages.map((img) => _ImageItem(
                                  imageUrl: "$projectImagePath/$img",
                                  onRemove: () {
                                    cpm.oldImages.remove(img);
                                    cpm.removedImages.value = [
                                      ...cpm.removedImages.value,
                                      img
                                    ];
                                    cpm.projectImage.value = [
                                      ...cpm.projectImage.value
                                    ];
                                  },
                                )),
                            ...images.map((file) => _ImageItem(
                                  file: file,
                                  onRemove: () {
                                    cpm.projectImage.value.remove(file);
                                    cpm.projectImage.value = [
                                      ...cpm.projectImage.value
                                    ];
                                  },
                                )),
                            GestureDetector(
                              onTap: () {
                                cpm.selectImage();
                              },
                              child: Container(
                                height: 100,
                                width: 100,
                                decoration: BoxDecoration(
                                  borderRadius: BorderRadius.circular(16),
                                  color: context.dProvider.black9,
                                  border: Border.all(
                                      color: context.dProvider.black8, width: 1.5),
                                ),
                                child: Center(
                                  child: Icon(Icons.add_photo_alternate_rounded,
                                      color: context.dProvider.primaryColor, size: 32),
                                ),
                              ),
                            ),
                          ],
                        ),
                      );
                    }),
                const SizedBox(height: 24),
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 20),
                  child: Text(
                    LocalKeys.recommendedProjectGalleryDimension,
                    style: context.bodySmall?.copyWith(
                      color: context.dProvider.black5,
                      fontWeight: FontWeight.w500,
                    ),
                  ),
                ),
                const SizedBox(height: 24),
                FieldWithLabel(
                  label: LocalKeys.serviceVideo,
                  hintText: LocalKeys.serviceVideoHint,
                  controller: cpm.videoUrlController,
                  isRequired: false,
                ).hp20,
                const SizedBox(height: 32),
                CreateProjectButtons().hp20,
              ],
            ),
          ),
          const SizedBox(height: 32),
        ],
      ),
    );
  }
}

class _ImageItem extends StatelessWidget {
  final File? file;
  final String? imageUrl;
  final VoidCallback onRemove;
  const _ImageItem({this.file, this.imageUrl, required this.onRemove});

  @override
  Widget build(BuildContext context) {
    return Stack(
      clipBehavior: Clip.none,
      alignment: Alignment.topRight,
      children: [
        Container(
          height: 100,
          width: 100,
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(8),
            color: context.dProvider.black9,
          ),
          child: ClipRRect(
            borderRadius: BorderRadius.circular(8),
            child: file != null
                ? Image.file(file!, fit: BoxFit.cover)
                : CachedNetworkImage(
                    imageUrl: imageUrl!,
                    fit: BoxFit.cover,
                    placeholder: (context, url) =>
                        const ImagePLWidget(size: 40),
                    errorWidget: (context, url, error) =>
                        const ImagePLWidget(size: 40),
                  ),
          ),
        ),
        Positioned(
          top: -8,
          right: -8,
          child: GestureDetector(
            onTap: onRemove,
            child: Container(
              padding: const EdgeInsets.all(4),
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: context.dProvider.whiteColor,
                boxShadow: [
                  BoxShadow(
                      color: Colors.black.withOpacity(0.1),
                      blurRadius: 4,
                      spreadRadius: 1)
                ],
              ),
              child: Icon(Icons.close,
                  size: 16, color: context.dProvider.warningColor),
            ),
          ),
        ),
      ],
    );
  }
}

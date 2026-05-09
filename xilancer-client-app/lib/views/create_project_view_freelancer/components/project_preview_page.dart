import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/view_models/create_project_view_model/create_project_view_model.dart';

class ProjectPreviewPage extends StatelessWidget {
  const ProjectPreviewPage({super.key});

  @override
  Widget build(BuildContext context) {
    final cpm = CreateProjectViewModel.instance;
    return Scaffold(
      appBar: AppBar(
        title: Text(LocalKeys.projectPreview),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              cpm.titleController.text.isEmpty ? LocalKeys.noTitle : cpm.titleController.text,
              style: context.titleLarge?.bold6,
            ),
            const SizedBox(height: 12),
            Row(
              children: [
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                  decoration: BoxDecoration(
                    color: context.dProvider.primaryColor.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(20),
                  ),
                  child: Text(
                    cpm.selectedCategory.value?.name ?? LocalKeys.noCategory,
                    style: context.titleSmall?.copyWith(color: context.dProvider.primaryColor),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 24),
            _SectionTitle(title: LocalKeys.description),
            const SizedBox(height: 8),
            Text(
              cpm.descriptionController.text.replaceAll(RegExp(r'<[^>]*>'), ''), // Strip HTML for preview
              style: context.bodyMedium,
            ),
            const SizedBox(height: 24),
            _SectionTitle(title: LocalKeys.galleryAndMedia),
            const SizedBox(height: 16),
            if (cpm.projectImage.value.isEmpty && cpm.oldImages.isEmpty)
              Center(
                child: Text(LocalKeys.noImagesSelected),
              )
            else
              SizedBox(
                height: 120,
                child: ListView(
                  scrollDirection: Axis.horizontal,
                  children: [
                    ...cpm.oldImages.map((e) => _PreviewImage(imageUrl: e)),
                    ...cpm.projectImage.value.map((e) => _PreviewImage(file: e)),
                  ],
                ),
              ),
            if (cpm.videoUrlController.text.isNotEmpty) ...[
              const SizedBox(height: 12),
              Row(
                children: [
                  const Icon(Icons.video_collection_outlined, size: 20),
                  const SizedBox(width: 8),
                  Expanded(
                    child: Text(
                      cpm.videoUrlController.text,
                      style: context.bodySmall?.copyWith(color: Colors.blue),
                    ),
                  ),
                ],
              ),
            ],
            const SizedBox(height: 24),
            _SectionTitle(title: LocalKeys.packages),
            const SizedBox(height: 12),
            ...cpm.packages.value.map((p) => Container(
                  margin: const EdgeInsets.only(bottom: 12),
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    color: context.dProvider.black9,
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Row(
                        mainAxisAlignment: MainAxisAlignment.spaceBetween,
                        children: [
                          Text(p.name, style: context.titleMedium?.bold6),
                          Text(
                            "\$${p.discountPrice}",
                            style: context.titleMedium?.bold6.copyWith(color: context.dProvider.primaryColor),
                          ),
                        ],
                      ),
                      const SizedBox(height: 8),
                      Text("${LocalKeys.deliveryColon}${p.deliveryTime}", style: context.bodySmall),
                      const SizedBox(width: 16),
                      Text("${LocalKeys.revisionsColon}${p.revision}", style: context.bodySmall),
                    ],
                  ),
                )),
          ],
        ),
      ),
    );
  }
}

class _SectionTitle extends StatelessWidget {
  final String title;
  const _SectionTitle({required this.title});

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(title, style: context.titleMedium?.bold6),
        const SizedBox(height: 4),
        Container(
          height: 2,
          width: 40,
          color: context.dProvider.primaryColor,
        ),
      ],
    );
  }
}

class _PreviewImage extends StatelessWidget {
  final String? imageUrl;
  final dynamic file;
  const _PreviewImage({this.imageUrl, this.file});

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: const EdgeInsets.only(right: 12),
      width: 120,
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(8),
        color: context.dProvider.black8,
      ),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(8),
        child: file != null
            ? Image.file(file, fit: BoxFit.cover)
            : (imageUrl != null
                ? Image.network(imageUrl!,
                    fit: BoxFit.cover,
                    errorBuilder: (c, e, s) => const Icon(Icons.broken_image))
                : const Icon(Icons.image)),
      ),
    );
  }
}

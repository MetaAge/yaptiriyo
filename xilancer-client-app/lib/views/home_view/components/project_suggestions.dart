import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/services/project_list_service.dart.dart';
import 'package:xilancer/services/search_history_service.dart';

import '../../../services/project_details_service.dart';
import '../../../utils/components/image_pl_widget.dart';
import '../../../view_models/project_details_view_model/project_details_view_model.dart';
import '../../project_details_view/project_details_view.dart';
import '../../../helper/local_keys.g.dart';

class ProjectSuggestions extends StatelessWidget {
  const ProjectSuggestions({super.key});

  @override
  Widget build(BuildContext context) {
    return Consumer<ProjectListService>(
      builder: (context, pl, child) {
        final projects = pl.suggestionProjects.projects?.projects ?? [];

        return Align(
          alignment: Alignment.topLeft,
          child: Padding(
            padding: const EdgeInsets.only(top: 8),
            child: SizedBox(
              width: context.width - 48,
              child: ClipRRect(
                borderRadius: BorderRadius.circular(24),
                child: BackdropFilter(
                  filter: ColorFilter.mode(
                    Colors.white.withOpacity(0.95),
                    BlendMode.srcOver,
                  ),
                  child: Container(
                    decoration: BoxDecoration(
                      color: context.dProvider.whiteColor.withOpacity(0.8),
                      borderRadius: BorderRadius.circular(24),
                      border: Border.all(color: Colors.white.withOpacity(0.4)),
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withOpacity(0.1),
                          blurRadius: 30,
                          offset: const Offset(0, 15),
                        ),
                      ],
                    ),
                    child: Column(
                      mainAxisSize: MainAxisSize.min,
                      children: [
                        SizedBox(
                          height: (context.height - context.viewPaddingBottom - 300).clamp(100, 400),
                          child: projects.isEmpty
                              ? _buildRecentSearches(context, pl)
                              : ListView.separated(
                                  padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 12),
                                  itemCount: projects.length < 6 ? projects.length : 5,
                                  separatorBuilder: (context, index) => const SizedBox(height: 8),
                                  itemBuilder: (context, index) {
                                    final e = projects[index];
                                    return InkWell(
                                      onTap: () async {
                                        context.unFocus;
                                        await SearchHistoryService.instance.addSearch(e.title ?? "");
                                        ProjectDetailsViewModel.dispose;
                                        context.toNamed(
                                          ProjectDetailsView.routeName,
                                          arguments: [e.id],
                                          then: () {
                                            Provider.of<ProjectDetailsService>(context, listen: false).removeProject(id: e.id);
                                          },
                                        );
                                      },
                                      borderRadius: BorderRadius.circular(16),
                                      child: Container(
                                        padding: const EdgeInsets.all(8),
                                        decoration: BoxDecoration(
                                          color: Colors.white.withOpacity(0.5),
                                          borderRadius: BorderRadius.circular(16),
                                        ),
                                        child: Row(
                                          children: [
                                            ClipRRect(
                                              borderRadius: BorderRadius.circular(12),
                                              child: Container(
                                                height: 48,
                                                width: 48,
                                                color: context.dProvider.black9,
                                                child: CachedNetworkImage(
                                                  fit: BoxFit.cover,
                                                  imageUrl: "${pl.suggestionProjects.projectFilePath}/${e.image}",
                                                  placeholder: (context, url) => const ImagePLWidget(size: 48),
                                                  errorWidget: (context, url, error) => const ImagePLWidget(size: 48),
                                                ),
                                              ),
                                            ),
                                            const SizedBox(width: 12),
                                            Expanded(
                                              child: Column(
                                                crossAxisAlignment: CrossAxisAlignment.start,
                                                children: [
                                                  Text(
                                                    e.title ?? "--",
                                                    maxLines: 1,
                                                    overflow: TextOverflow.ellipsis,
                                                    style: context.bodyMedium?.copyWith(
                                                      fontWeight: FontWeight.bold,
                                                      color: context.dProvider.black2,
                                                    ),
                                                  ),
                                                  const SizedBox(height: 4),
                                                  Row(
                                                    children: [
                                                      Text(
                                                        "₺${e.basicRegularCharge}",
                                                        style: TextStyle(
                                                          fontSize: 12,
                                                          fontWeight: FontWeight.bold,
                                                          color: context.dProvider.primaryColor,
                                                        ),
                                                      ),
                                                      const SizedBox(width: 8),
                                                      Icon(Icons.star_rounded, size: 12, color: Colors.amber[700]),
                                                      const SizedBox(width: 2),
                                                      Text(
                                                        "${e.avgRating ?? "0.0"}",
                                                        style: TextStyle(fontSize: 11, color: context.dProvider.black5),
                                                      ),
                                                    ],
                                                  ),
                                                ],
                                              ),
                                            ),
                                            Icon(Icons.arrow_forward_ios_rounded, size: 14, color: context.dProvider.black7),
                                          ],
                                        ),
                                      ),
                                    );
                                  },
                                ),
                        ),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
        );
      },
    );
  }

  Widget _buildRecentSearches(BuildContext context, ProjectListService pl) {
    return FutureBuilder<List<String>>(
      future: SearchHistoryService.instance.getHistory(),
      builder: (context, snapshot) {
        final history = snapshot.data ?? [];
        if (history.isEmpty) {
          return Center(
            child: Column(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Icon(Icons.search_off_rounded, size: 48, color: context.dProvider.black7),
                const SizedBox(height: 12),
                Text(
                  LocalKeys.noResultFound,
                  style: context.bodyMedium?.copyWith(
                    color: context.dProvider.black5,
                  ),
                ),
              ],
            ),
          );
        }

        return Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Padding(
              padding: const EdgeInsets.fromLTRB(16, 16, 16, 8),
              child: Row(
                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                children: [
                  Text(
                    "Son Aramalar",
                    style: context.bodySmall?.copyWith(fontWeight: FontWeight.bold, color: context.dProvider.black5),
                  ),
                  GestureDetector(
                    onTap: () async {
                      await SearchHistoryService.instance.clearHistory();
                      (context as Element).markNeedsBuild();
                    },
                    child: Text(
                      "Temizle",
                      style: context.bodySmall?.copyWith(color: context.dProvider.primaryColor),
                    ),
                  ),
                ],
              ),
            ),
            Expanded(
              child: ListView.builder(
                padding: EdgeInsets.zero,
                itemCount: history.length,
                itemBuilder: (context, index) {
                  return ListTile(
                    leading: Icon(Icons.history_rounded, size: 20, color: context.dProvider.black7),
                    title: Text(history[index], style: context.bodyMedium),
                    trailing: const Icon(Icons.north_west_rounded, size: 16),
                    onTap: () {
                      context.unFocus;
                      pl.setSearchText(history[index]);
                      pl.fetchProjectList();
                    },
                  );
                },
              ),
            ),
          ],
        );
      },
    );
  }
}

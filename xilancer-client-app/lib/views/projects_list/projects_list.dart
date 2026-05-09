import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/project_list_service.dart.dart';
import 'package:xilancer/utils/components/custom_refresh_indicator.dart';
import 'package:xilancer/utils/components/empty_widget.dart';
import 'package:xilancer/views/projects_list/components/project_card.dart';

import '../../utils/components/scrolling_preloader.dart';
import '../../view_models/home_drawer_view_model/home_drawer_view_model.dart';
import '../../view_models/home_view_model/home_view_model.dart';
import 'package:xilancer/views/home_view/components/home_categories.dart';
import 'components/project_list_skeleton.dart';


import 'package:xilancer/views/home_view/components/service_section_header.dart';
import 'package:xilancer/services/profile_info_service.dart';
import 'package:xilancer/views/profile_edit_view/profile_edit_view.dart';
import 'package:xilancer/views/projects_list/components/project_card_small.dart';

class ProjectsList extends StatelessWidget {
  const ProjectsList({super.key});

  @override
  Widget build(BuildContext context) {
    final hvm = HomeViewModel.instance;
    hvm.scrollController.addListener(() {
      hvm.tryToLoadMore(context);
    });
    return CustomRefreshIndicator(
      onRefresh: () async {
        await Provider.of<ProjectListService>(context, listen: false)
            .fetchProjectList(refreshing: true);
      },
      child: Consumer<ProjectListService>(builder: (context, pl, child) {
        final hdm = HomeDrawerViewModel.instance;
        if (pl.shouldAutoFetch) {
          WidgetsBinding.instance.addPostFrameCallback((_) {
            pl.fetchProjectList();
          });
        }
        return ValueListenableBuilder(
            valueListenable: hdm.isLoading,
            builder: (context, loading, child) {
              final projects = pl.projectListModel.projects?.projects ?? [];
              final projectsPath = pl.projectListModel.projectFilePath ?? "";

              if (loading) {
                return SingleChildScrollView(
                  child: Column(
                    children: [
                      _buildHeader(context, pl),
                      const ProjectListSkeleton(),
                    ],
                  ),
                );
              }

              if (projects.isEmpty) {
                return SingleChildScrollView(
                  physics: const AlwaysScrollableScrollPhysics(),
                  child: Column(
                    children: [
                      _buildHeader(context, pl),
                      SizedBox(
                        height: context.height / 2,
                        child: EmptyWidget(title: LocalKeys.noProjectsFound),
                      ),
                    ],
                  ),
                );
              }

              // Filter logic
              final proProjects = projects.where((p) => p.isPro).toList();
              final popularProjects = projects.where((p) => (p.avgRating ?? 0) >= 4).take(4).toList();
              final recentProjects = projects.reversed.take(10).toList();

              return SingleChildScrollView(
                controller: hvm.scrollController,
                physics: const AlwaysScrollableScrollPhysics(),
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    _buildHeader(context, pl),
                    
                    // Sponsorlu Hizmetler (Horizontal)
                    if (proProjects.isNotEmpty) ...[
                      const ServiceSectionHeader(
                        title: "Öne Çıkanlar",
                        icon: Icons.rocket_launch_rounded,
                      ),
                      SizedBox(
                        height: 240,
                        child: ListView.builder(
                          padding: const EdgeInsets.symmetric(horizontal: 20),
                          scrollDirection: Axis.horizontal,
                          itemCount: proProjects.length,
                          itemBuilder: (context, index) => ProjectCardSmall(
                            project: proProjects[index],
                            projectsPath: projectsPath,
                            width: 165,
                          ),
                        ),
                      ),
                      const SizedBox(height: 12),
                    ],

                    // En Sevilenler (2-Column Grid)
                    if (popularProjects.isNotEmpty) ...[
                      const ServiceSectionHeader(
                        title: "En Sevilen Hizmetler",
                        icon: Icons.favorite_rounded,
                      ),
                      GridView.builder(
                        shrinkWrap: true,
                        physics: const NeverScrollableScrollPhysics(),
                        padding: const EdgeInsets.symmetric(horizontal: 20),
                        gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                          crossAxisCount: 2,
                          crossAxisSpacing: 16,
                          mainAxisSpacing: 16,
                          childAspectRatio: 0.75,
                        ),
                        itemCount: popularProjects.length,
                        itemBuilder: (context, index) => ProjectCardSmall(
                          project: popularProjects[index],
                          projectsPath: projectsPath,
                        ),
                      ),
                      const SizedBox(height: 12),
                    ],

                    // Tüm Hizmetler / En Yeni (Vertical)
                    const ServiceSectionHeader(title: "Tüm Hizmetler"),
                    ListView.separated(
                      shrinkWrap: true,
                      physics: const NeverScrollableScrollPhysics(),
                      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
                      itemCount: projects.length,
                      separatorBuilder: (context, index) => const SizedBox(height: 16),
                      itemBuilder: (context, index) => ProjectCard(
                        project: projects[index],
                        projectsPath: projectsPath,
                      ),
                    ),

                    if (pl.nextPage != null && !pl.nexLoadingFailed)
                      Padding(
                        padding: const EdgeInsets.symmetric(vertical: 20),
                        child: ScrollPreloader(loading: pl.nextPageLoading),
                      ),
                    
                    const SizedBox(height: 120),
                  ],
                ),
              );
            });
      }),
    );
  }

  Widget _buildHeader(BuildContext context, ProjectListService pl) {
    final profileService = Provider.of<ProfileInfoService>(context, listen: false);
    final profile = profileService.profileInfoModel.data;
    
    // Calculate completeness
    double completeness = 0;
    if (profile != null) {
      if (profile.firstName != null && profile.lastName != null) completeness += 0.1;
      if (profile.email != null) completeness += 0.1;
      if (profile.phone != null) completeness += 0.1;
      if (profile.image != null) completeness += 0.1;
      if (profile.countryId != null) completeness += 0.1;
      if (profile.stateId != null) completeness += 0.05;
      if (profile.cityId != null) completeness += 0.05;
      if (profile.experienceLevel != null) completeness += 0.1;
      if (profile.userIntroduction?.title != null) completeness += 0.15;
      if (profile.userIntroduction?.description != null) completeness += 0.15;
    }
    
    final int percent = (completeness * 100).toInt();

    return Column(
      children: [
        const HomeCategories(),
        
        if (percent < 100 && profile != null)
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 8),
            child: InkWell(
              onTap: () {
                HapticFeedback.lightImpact();
                Navigator.pushNamed(context, ProfileEditView.routeName);
              },
              borderRadius: BorderRadius.circular(20),
              child: Container(
                padding: const EdgeInsets.all(16),
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    colors: [context.dProvider.primaryColor, context.dProvider.primaryColor.withOpacity(0.8)],
                    begin: Alignment.topLeft,
                    end: Alignment.bottomRight,
                  ),
                  borderRadius: BorderRadius.circular(20),
                  boxShadow: [
                    BoxShadow(
                      color: context.dProvider.primaryColor.withOpacity(0.3),
                      blurRadius: 15,
                      offset: const Offset(0, 8),
                    ),
                  ],
                ),
                child: Row(
                  children: [
                    Container(
                      padding: const EdgeInsets.all(10),
                      decoration: BoxDecoration(
                        color: Colors.white.withOpacity(0.2),
                        shape: BoxShape.circle,
                      ),
                      child: const Icon(Icons.person_outline, color: Colors.white, size: 24),
                    ),
                    const SizedBox(width: 16),
                    Expanded(
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Text(
                            "Profilini Tamamla",
                            style: context.titleSmall?.copyWith(color: Colors.white, fontWeight: FontWeight.bold),
                          ),
                          const SizedBox(height: 4),
                          Text(
                            "Profilini %100 tamamlayarak daha güvenilir bir profil oluştur.",
                            style: context.bodySmall?.copyWith(color: Colors.white.withOpacity(0.9), fontSize: 11),
                          ),
                          const SizedBox(height: 12),
                          Stack(
                            children: [
                              Container(
                                height: 6,
                                decoration: BoxDecoration(
                                  color: Colors.white.withOpacity(0.3),
                                  borderRadius: BorderRadius.circular(3),
                                ),
                              ),
                              AnimatedContainer(
                                duration: const Duration(seconds: 1),
                                height: 6,
                                width: (context.width - 112) * completeness,
                                decoration: BoxDecoration(
                                  color: Colors.white,
                                  borderRadius: BorderRadius.circular(3),
                                ),
                              ),
                            ],
                          ),
                        ],
                      ),
                    ),
                    const SizedBox(width: 12),
                    Text(
                      "%$percent",
                      style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold, fontSize: 16),
                    ),
                  ],
                ),
              ),
            ),
          ),

        Padding(
          padding: const EdgeInsets.symmetric(vertical: 12),
          child: SizedBox(
            height: 38,
            child: ListView(
              scrollDirection: Axis.horizontal,
              padding: const EdgeInsets.symmetric(horizontal: 20),
              children: [
                _buildFilterChip(
                  context,
                  label: "Hepsi",
                  isSelected: !pl.proProjects && pl.sortBy == null,
                  onTap: () => pl.setFilters(pl.country, pl.state, pl.city, pl.length, pl.maxPrice, pl.minPrice, pl.category, pl.subCat, pl.rating, proProjects: false),
                ),
                _buildFilterChip(
                  context,
                  label: "Öne Çıkanlar",
                  isSelected: pl.proProjects,
                  onTap: () => pl.setFilters(pl.country, pl.state, pl.city, pl.length, pl.maxPrice, pl.minPrice, pl.category, pl.subCat, pl.rating, proProjects: true),
                ),
                _buildFilterChip(
                  context,
                  label: "En Yeni",
                  isSelected: !pl.proProjects && pl.sortBy == null,
                  onTap: () => pl.setSort(null, null),
                ),
                _buildFilterChip(
                  context,
                  label: "En Uygun",
                  isSelected: pl.sortBy == 'price',
                  onTap: () => pl.setSort('price', 'asc'),
                ),
                _buildFilterChip(
                  context,
                  label: "Popüler",
                  isSelected: pl.sortBy == 'rating',
                  onTap: () => pl.setSort('rating', 'desc'),
                ),
              ],
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildFilterChip(BuildContext context, {required String label, required bool isSelected, required VoidCallback onTap}) {
    return Padding(
      padding: const EdgeInsets.only(right: 8),
      child: InkWell(
        onTap: () {
          HapticFeedback.lightImpact();
          onTap();
        },
        borderRadius: BorderRadius.circular(20),
        child: Container(
          padding: const EdgeInsets.symmetric(horizontal: 16),
          alignment: Alignment.center,
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(20),
            color: isSelected 
                ? context.dProvider.primaryColor 
                : context.dProvider.whiteColor,
            border: Border.all(
              color: isSelected 
                  ? Colors.transparent 
                  : context.dProvider.black9.withOpacity(0.1),
            ),
            boxShadow: [
              BoxShadow(
                color: isSelected 
                    ? context.dProvider.primaryColor.withOpacity(0.2)
                    : Colors.black.withOpacity(0.03),
                blurRadius: 8,
                offset: const Offset(0, 2),
              ),
            ],
          ),
          child: Text(
            label,
            style: context.bodySmall?.copyWith(
              color: isSelected 
                  ? Colors.white 
                  : context.dProvider.black3,
              fontWeight: isSelected ? FontWeight.bold : FontWeight.normal,
            ),
          ),
        ),
      ),
    );
  }
}

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/category_dropdown_service.dart';
import 'package:xilancer/services/project_list_service.dart.dart';
import 'package:xilancer/helper/extension/widget_extension.dart';
import 'package:xilancer/view_models/home_drawer_view_model/home_drawer_view_model.dart';
import 'package:xilancer/view_models/onboarding_view_model/onboarding_view_model.dart';

class HomeCategories extends StatefulWidget {
  const HomeCategories({super.key});

  @override
  State<HomeCategories> createState() => _HomeCategoriesState();
}

class _HomeCategoriesState extends State<HomeCategories> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      Provider.of<CategoryDropdownService>(context, listen: false).getCategory();
    });
  }

  IconData _getIconForCategory(String name) {
    name = name.toLowerCase();
    if (name.contains('web') || name.contains('software')) return Icons.code_rounded;
    if (name.contains('design') || name.contains('graphic')) return Icons.brush_rounded;
    if (name.contains('writing') || name.contains('content')) return Icons.edit_note_rounded;
    if (name.contains('video') || name.contains('animation')) return Icons.videocam_rounded;
    if (name.contains('marketing') || name.contains('seo')) return Icons.trending_up_rounded;
    if (name.contains('business') || name.contains('consult')) return Icons.business_center_rounded;
    if (name.contains('data') || name.contains('analysis')) return Icons.analytics_rounded;
    if (name.contains('mobile') || name.contains('app')) return Icons.phone_android_rounded;
    return Icons.category_rounded;
  }

  LinearGradient _getCategoryGradient(int index) {
    List<List<Color>> gradients = [
      [const Color(0xFF6366F1), const Color(0xFF818CF8)], // Indigo
      [const Color(0xFFF59E0B), const Color(0xFFFBBF24)], // Amber
      [const Color(0xFF10B981), const Color(0xFF34D399)], // Emerald
      [const Color(0xFFEC4899), const Color(0xFFF472B6)], // Pink
      [const Color(0xFF3B82F6), const Color(0xFF60A5FA)], // Blue
      [const Color(0xFF8B5CF6), const Color(0xFFA78BFA)], // Violet
      [const Color(0xFFF97316), const Color(0xFFFB923C)], // Orange
      [const Color(0xFF06B6D4), const Color(0xFF22D3EE)], // Cyan
    ];
    var colors = gradients[index % gradients.length];
    return LinearGradient(
      begin: Alignment.topLeft,
      end: Alignment.bottomRight,
      colors: colors,
    );
  }

  @override
  Widget build(BuildContext context) {
    return Consumer2<CategoryDropdownService, ProjectListService>(
      builder: (context, catService, plService, child) {
        if (catService.categoryLoading && catService.categoryDropdownList.isEmpty) {
          return _buildSkeleton(context);
        }

        final categories = catService.categoryDropdownList;
        if (categories.isEmpty) return const SizedBox.shrink();

        return Container(
          margin: const EdgeInsets.symmetric(vertical: 8),
          padding: const EdgeInsets.only(bottom: 20),
          decoration: BoxDecoration(
            color: context.dProvider.black9.withOpacity(0.4),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Padding(
                padding: const EdgeInsets.fromLTRB(24, 20, 24, 16),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(
                      LocalKeys.browseCategories,
                      style: context.titleSmall?.copyWith(
                        fontWeight: FontWeight.bold,
                        fontSize: 16,
                        color: context.dProvider.black2,
                      ),
                    ),
                    GestureDetector(
                      onTap: () {
                        // Open Filter Drawer
                        final ov = OnboardingViewModel.instance;
                        final jl = Provider.of<ProjectListService>(context, listen: false);
                        final hdm = HomeDrawerViewModel.instance;
                        hdm.setValues(
                          jl.country,
                          jl.state,
                          jl.city,
                          jl.length,
                          jl.maxPrice,
                          jl.minPrice,
                          jl.category,
                          jl.subCat,
                          jl.rating,
                          jl.proProjects,
                        );
                        ov.scaffoldKey.currentState?.openDrawer();
                      },
                      child: Text(
                        LocalKeys.viewAll,
                        style: context.bodySmall?.copyWith(
                          color: context.dProvider.primaryColor,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ),
                  ],
                ),
              ),
              SizedBox(
                height: 125,
                child: ListView.separated(
                  scrollDirection: Axis.horizontal,
                  padding: const EdgeInsets.symmetric(horizontal: 24),
                  itemCount: categories.length,
                  separatorBuilder: (context, index) => const SizedBox(width: 16),
                  itemBuilder: (context, index) {
                    final category = categories[index];
                    if (category == null) return const SizedBox.shrink();
                    final isSelected = plService.category?.id == category.id;

                    return GestureDetector(
                      onTap: () {
                        HapticFeedback.selectionClick();
                        if (isSelected) {
                          plService.setFilters(
                            plService.country,
                            plService.state,
                            plService.city,
                            plService.length,
                            plService.maxPrice,
                            plService.minPrice,
                            null,
                            null,
                            plService.rating,
                          );
                        } else {
                          plService.setFilters(
                            plService.country,
                            plService.state,
                            plService.city,
                            plService.length,
                            plService.maxPrice,
                            plService.minPrice,
                            category,
                            null,
                            plService.rating,
                          );
                        }
                      },
                      child: AnimatedContainer(
                        duration: const Duration(milliseconds: 300),
                        width: 130,
                        curve: Curves.easeInOut,
                        padding: const EdgeInsets.all(14),
                        decoration: BoxDecoration(
                          color: isSelected 
                              ? context.dProvider.primaryColor 
                              : context.dProvider.whiteColor,
                          gradient: isSelected 
                              ? LinearGradient(
                                  colors: [context.dProvider.primaryColor, context.dProvider.primaryColor.withOpacity(0.8)],
                                  begin: Alignment.topLeft,
                                  end: Alignment.bottomRight,
                                )
                              : null,
                          borderRadius: BorderRadius.circular(20),
                          border: Border.all(
                            color: isSelected 
                                ? Colors.transparent 
                                : context.dProvider.black9.withOpacity(0.1),
                            width: 1,
                          ),
                          boxShadow: [
                            BoxShadow(
                              color: isSelected 
                                  ? context.dProvider.primaryColor.withOpacity(0.25)
                                  : Colors.black.withOpacity(0.04),
                              blurRadius: 10,
                              offset: const Offset(0, 4),
                            ),
                          ],
                        ),
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Container(
                              padding: const EdgeInsets.all(8),
                              decoration: BoxDecoration(
                                color: isSelected 
                                    ? Colors.white.withOpacity(0.2) 
                                    : _getCategoryGradient(index).colors.first.withOpacity(0.1),
                                borderRadius: BorderRadius.circular(12),
                              ),
                              child: Icon(
                                _getIconForCategory(category.name ?? ""),
                                size: 22,
                                color: isSelected ? Colors.white : _getCategoryGradient(index).colors.first,
                              ),
                            ),
                            const Spacer(),
                            Text(
                              category.name ?? "",
                              maxLines: 1,
                              overflow: TextOverflow.ellipsis,
                              style: context.bodySmall?.copyWith(
                                fontSize: 14,
                                fontWeight: FontWeight.bold,
                                color: isSelected ? Colors.white : context.dProvider.black2,
                              ),
                            ),
                            const SizedBox(height: 2),
                            Text(
                              "Göz At",
                              style: context.bodySmall?.copyWith(
                                fontSize: 11,
                                fontWeight: FontWeight.w500,
                                color: isSelected ? Colors.white70 : context.dProvider.black5,
                              ),
                            ),
                          ],
                        ),
                      ),
                    );
                  },
                ),
              ),
            ],
          ),
        );
      },
    );
  }

  Widget _buildSkeleton(BuildContext context) {
    return Container(
      height: 140,
      margin: const EdgeInsets.symmetric(vertical: 8),
      padding: const EdgeInsets.symmetric(vertical: 20),
      child: ListView.builder(
        padding: const EdgeInsets.symmetric(horizontal: 20),
        scrollDirection: Axis.horizontal,
        itemCount: 5,
        itemBuilder: (context, index) => Container(
          width: 80,
          margin: const EdgeInsets.only(right: 16),
          child: Column(
            children: [
              Container(
                height: 60,
                width: 60,
                decoration: BoxDecoration(
                  color: context.dProvider.whiteColor,
                  shape: BoxShape.circle,
                ),
              ),
              const SizedBox(height: 12),
              Container(
                height: 12,
                width: 50,
                decoration: BoxDecoration(
                  color: context.dProvider.whiteColor,
                  borderRadius: BorderRadius.circular(6),
                ),
              ),
            ],
          ),
        ),
      ),
    ).shim;
  }
}

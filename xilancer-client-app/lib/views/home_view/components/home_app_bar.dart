import 'dart:io';
import 'dart:ui';

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_animate/flutter_animate.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/services/profile_info_service.dart';
import 'package:xilancer/services/project_list_service.dart.dart';
import 'package:xilancer/view_models/home_drawer_view_model/home_drawer_view_model.dart';

import 'package:badges/badges.dart' as badges;
import 'package:xilancer/services/message_notification_count_service.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'home_address_bar.dart';
import 'project_search_field.dart';
import '../../notifications_list_view/notifications_list_view.dart';
import '../../../helper/svg_assets.dart';
import '../../../view_models/onboarding_view_model/onboarding_view_model.dart';
import 'package:xilancer/services/user_mode_service.dart';

class HomeAppBar extends StatelessWidget {
  const HomeAppBar({super.key});

  @override
  Widget build(BuildContext context) {
    final ov = OnboardingViewModel.instance;
    return Container(
      width: double.infinity,
      decoration: BoxDecoration(
        color: context.dProvider.black9,
      ),
      child: Stack(
        children: [
          // Mesh Gradient Background
          Positioned.fill(
            child: ClipRect(
              child: BackdropFilter(
                filter: ImageFilter.blur(sigmaX: 10, sigmaY: 10),
                child: Container(
                  decoration: BoxDecoration(
                    gradient: LinearGradient(
                      begin: Alignment.topLeft,
                      end: Alignment.bottomRight,
                      colors: [
                        context.dProvider.primaryColor.withOpacity(0.9),
                        context.dProvider.primaryColor.withOpacity(0.8),
                        context.dProvider.primaryColor.withOpacity(0.7),
                      ],
                    ),
                  ),
                ),
              ),
            ),
          ),
          Positioned(
            top: -50,
            right: -50,
            child: Container(
              width: 200,
              height: 200,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.white.withOpacity(0.1),
              ),
            ),
          ),
          Positioned(
            bottom: -30,
            left: -30,
            child: Container(
              width: 150,
              height: 150,
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: Colors.black.withOpacity(0.05),
              ),
            ),
          ),
          
          SafeArea(
            bottom: false,
            child: Padding(
              padding: const EdgeInsets.fromLTRB(24, 12, 24, 20),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Top Row: Profile, Address & Notifications
                  Row(
                    children: [
                      // Profile
                      Consumer<ProfileInfoService>(builder: (context, pi, child) {
                        final image = pi.profileInfoModel.data?.cloudImage ??
                            pi.profileInfoModel.data?.image;
                        final hasImage = image != null && image.isNotEmpty;
                        return Container(
                          height: 38,
                          width: 38,
                          decoration: BoxDecoration(
                            shape: BoxShape.circle,
                            border: Border.all(color: Colors.white24, width: 1.5),
                            color: Colors.white24,
                          ),
                          child: ClipRRect(
                            borderRadius: BorderRadius.circular(19),
                            child: hasImage
                                ? CachedNetworkImage(
                                    imageUrl: image,
                                    fit: BoxFit.cover,
                                    placeholder: (context, url) =>
                                        const Icon(Icons.person,
                                            size: 18, color: Colors.white70),
                                    errorWidget: (context, url, error) =>
                                        const Icon(Icons.person,
                                            size: 18, color: Colors.white70),
                                  )
                                : const Icon(Icons.person,
                                    size: 18, color: Colors.white70),
                          ),
                        );
                      }),
                      const SizedBox(width: 10),
                      // Welcome & Address
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Consumer<ProfileInfoService>(builder: (context, pi, child) {
                              final name = pi.profileInfoModel.data?.firstName ?? "Misafir";
                              return Text(
                                "${LocalKeys.welcomeBack}, $name",
                                style: context.bodySmall?.copyWith(
                                  color: Colors.white,
                                  fontWeight: FontWeight.w600,
                                  fontSize: 12,
                                ),
                                maxLines: 1,
                                overflow: TextOverflow.ellipsis,
                              );
                            }),
                            const SizedBox(height: 2),
                            const HomeAddressBarCompact(),
                          ],
                        ),
                      ),
                      const SizedBox(width: 10),
                      // Notifications
                      Consumer<MessageNotificationCountService>(
                          builder: (context, mnc, child) {
                        return InkWell(
                          onTap: () {
                            HapticFeedback.lightImpact();
                            Navigator.push(
                                context,
                                MaterialPageRoute(
                                    builder: (context) =>
                                        const NotificationListView()));
                          },
                          child: Container(
                            height: 38,
                            width: 38,
                            decoration: BoxDecoration(
                              shape: BoxShape.circle,
                              color: Colors.white.withOpacity(0.15),
                            ),
                            child: Center(
                              child: mnc.notificationCount > 0
                                  ? badges.Badge(
                                      badgeContent: Text(
                                        mnc.notificationCount.toString(),
                                        style: const TextStyle(
                                            color: Colors.white, fontSize: 8),
                                      ),
                                      child: const Icon(
                                          Icons.notifications_none_rounded,
                                          size: 20,
                                          color: Colors.white),
                                    ).animate(onPlay: (controller) => controller.repeat())
                                     .shake(delay: 2.seconds, duration: 500.ms)
                                  : const Icon(Icons.notifications_none_rounded,
                                      size: 20, color: Colors.white),
                            ),
                          ),
                        );
                      }),
                    ],
                  ),
                  
                  const SizedBox(height: 16),
                  
                  // Bottom Row: Search, Filter, Sort (Compact Glassy)
                  Row(
                    children: [
                      Expanded(
                        child: Container(
                          height: 40,
                          decoration: BoxDecoration(
                            borderRadius: BorderRadius.circular(12),
                            color: Colors.white.withOpacity(0.15),
                            border: Border.all(color: Colors.white.withOpacity(0.1)),
                          ),
                          child: const ProjectSearchField(),
                        ).animate(onPlay: (controller) => controller.repeat())
                         .shimmer(delay: 5.seconds, duration: 2.seconds, color: Colors.white.withOpacity(0.1)),
                      ),
                      const SizedBox(width: 10),
                      _buildHeaderButton(
                        context: context,
                        icon: Icons.tune_rounded,
                        onTap: () {
                          final jl = Provider.of<ProjectListService>(context, listen: false);
                          final hdm = HomeDrawerViewModel.instance;
                          hdm.setValues(jl.country, jl.state, jl.city, jl.length, jl.maxPrice, jl.minPrice, jl.category, jl.subCat, jl.rating, jl.proProjects);
                          ov.scaffoldKey.currentState?.openDrawer();
                        },
                      ),
                      const SizedBox(width: 10),
                      _buildHeaderButton(
                        context: context,
                        icon: Icons.sort_rounded,
                        onTap: () => _showSortSheet(context),
                      ),
                    ],
                  ),
                  
                  // Location Indicator (Optional but nice)
                  Consumer<ProjectListService>(builder: (context, pl, child) {
                    if (pl.city?.name == null) return const SizedBox.shrink();
                    return Padding(
                      padding: const EdgeInsets.only(top: 12),
                      child: Row(
                        children: [
                          const Icon(Icons.location_on_rounded, size: 14, color: Colors.white70),
                          const SizedBox(width: 4),
                          Text(
                            pl.city?.name ?? "",
                            style: context.bodySmall?.copyWith(color: Colors.white70, fontSize: 12),
                          ),
                        ],
                      ),
                    );
                  }),
                ],
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildHeaderButton({required BuildContext context, required IconData icon, required VoidCallback onTap}) {
    return InkWell(
      onTap: () {
        HapticFeedback.lightImpact();
        onTap();
      },
      borderRadius: BorderRadius.circular(10),
      child: Container(
        height: 40,
        width: 40,
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(10),
          color: Colors.white.withOpacity(0.15),
          border: Border.all(color: Colors.white.withOpacity(0.1)),
        ),
        child: Icon(icon, color: Colors.white, size: 20),
      ),
    ).animate()
     .scale(duration: 200.ms, begin: const Offset(1, 1), end: const Offset(0.9, 0.9), curve: Curves.easeInOut);
  }

  void _showSortSheet(BuildContext context) {
    showModalBottomSheet(
      context: context,
      backgroundColor: Colors.transparent,
      builder: (context) {
        final pl = Provider.of<ProjectListService>(context, listen: false);
        return Container(
          padding: const EdgeInsets.all(24),
          decoration: BoxDecoration(
            color: context.dProvider.whiteColor,
            borderRadius: const BorderRadius.vertical(top: Radius.circular(32)),
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              Container(
                width: 40,
                height: 4,
                decoration: BoxDecoration(
                  color: context.dProvider.black8,
                  borderRadius: BorderRadius.circular(2),
                ),
              ),
              24.toHeight,
              Text(LocalKeys.sortBy, style: context.titleMedium?.bold6),
              16.toHeight,
              _sortTile(context, pl, LocalKeys.latest, null, null),
              _sortTile(context, pl, LocalKeys.priceLowToHigh, 'price', 'asc'),
              _sortTile(context, pl, LocalKeys.priceHighToLow, 'price', 'desc'),
              _sortTile(context, pl, LocalKeys.ratingHighToLow, 'rating', 'desc'),
              _sortTile(context, pl, LocalKeys.ratingLowToHigh, 'rating', 'asc'),
              20.toHeight,
            ],
          ),
        );
      },
    );
  }

  Widget _sortTile(BuildContext context, ProjectListService pl, String title, String? by, String? type) {
    final isSelected = pl.sortBy == by && pl.sortType == type;
    return ListTile(
      contentPadding: EdgeInsets.zero,
      title: Text(title, style: context.bodyMedium?.copyWith(
        fontWeight: isSelected ? FontWeight.bold : FontWeight.normal,
        color: isSelected ? context.dProvider.primaryColor : context.dProvider.black2,
      )),
      trailing: isSelected ? Icon(Icons.check_circle_rounded, color: context.dProvider.primaryColor) : null,
      onTap: () {
        pl.setSort(by, type);
        Navigator.pop(context);
      },
    );
  }
}

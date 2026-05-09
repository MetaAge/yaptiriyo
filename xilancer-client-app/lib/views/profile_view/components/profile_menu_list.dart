import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/svg_assets.dart';
import '../../../services/user_mode_service.dart';
import '../../../../view_models/onboarding_view_model/onboarding_view_model.dart';
import '../../profile_settings_view/profile_settings_view.dart';
import '../../../../helper/extension/string_extension.dart';

import '/helper/extension/context_extension.dart';
import '/helper/local_keys.g.dart';

import 'profile_menu_tile.dart';

class ProfileMenuList extends StatelessWidget {
  const ProfileMenuList({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(8),
      ),
      child: Column(
        children: [
          ProfileMenuTile(
            title: LocalKeys.profileSettings0,
            svg: SvgAssets.setting,
            onPress: () {
              context.toNamed(ProfileSettingsView.routeName);
            },
          ),
          Consumer<UserModeService>(builder: (context, um, child) {
            return ProfileMenuTile(
                title: um.isClient
                    ? LocalKeys.switchToFreelancerMode
                    : LocalKeys.switchToClientMode,
                svg: SvgAssets.home,
                onPress: () {
                  um.toggleMode();
                  um.onModeChange(context);
                  OnboardingViewModel.instance.setNavIndex(0);
                  "${LocalKeys.switchedTo} ${um.isFreelancer ? LocalKeys.freelancer : LocalKeys.customer}"
                      .showToast();
                },
              );
            }),
        ],
      ),
    );
  }
}

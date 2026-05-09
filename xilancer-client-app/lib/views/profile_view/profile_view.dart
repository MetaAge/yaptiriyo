import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/services/auth/sign_out_service.dart';
import 'package:xilancer/services/profile_info_service.dart';
import 'package:xilancer/services/dynamics/dynamics_service.dart';
import 'package:xilancer/services/user_address_service.dart';
import 'package:xilancer/views/account_skeleton/account_skeleton.dart';
import '../../helper/local_keys.g.dart';
import '../../helper/svg_assets.dart';
import '../../utils/components/alerts.dart';
import 'package:xilancer/services/user_mode_service.dart';
import '/utils/components/empty_spacer_helper.dart';

import 'package:xilancer/main.dart';
import 'package:xilancer/views/splash_view/splash_view.dart';
import '../../view_models/onboarding_view_model/onboarding_view_model.dart';
import 'package:xilancer/view_models/promotion_payment_view_model/promotion_payment_view_model.dart';
import 'package:xilancer/views/promotion_payment_view/promotion_payment_view.dart';
import 'components/profile_menu_list.dart';
import 'components/profile_menu_tile.dart';
import 'components/profile_view_app_bar.dart';

class ProfileView extends StatelessWidget {
  const ProfileView({super.key});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        const ProfileViewAppBar(),
        16.toHeight,
        Consumer<ProfileInfoService>(builder: (context, pi, child) {
          return Expanded(
            child: pi.profileInfoModel.data == null
                ? Column(
                    children: [
                      const Expanded(child: AccountSkeleton()),
                      16.toHeight,
                    ],
                  )
                : ListView(
                    padding: const EdgeInsets.only(bottom: 100),
                    children: [
                      Consumer<UserModeService>(builder: (context, um, child) {
                        return um.isFreelancer
                            ? _buildPromoteBanner(context, pi)
                            : const SizedBox.shrink();
                      }),
                      16.toHeight,
                      const ProfileMenuList(),
                      16.toHeight,
                      Padding(
                        padding: const EdgeInsets.symmetric(horizontal: 20),
                        child: Column(
                          children: [
                            Consumer<DynamicsService>(builder: (context, dynamicProv, child) {
                              return Container(
                                decoration: BoxDecoration(
                                  color: context.dProvider.whiteColor,
                                  borderRadius: BorderRadius.circular(16),
                                  border: Border.all(color: context.dProvider.black8.withOpacity(0.5)),
                                ),
                                child: SwitchListTile.adaptive(
                                  contentPadding: const EdgeInsets.symmetric(horizontal: 16),
                                  title: Text(
                                    LocalKeys.darkMode,
                                    style: context.titleSmall?.copyWith(
                                      fontWeight: FontWeight.bold,
                                      color: context.dProvider.black3,
                                    ),
                                  ),
                                  value: dynamicProv.isDarkMode,
                                  activeColor: context.dProvider.primaryColor,
                                  onChanged: (val) {
                                    dynamicProv.toggleDarkMode();
                                  },
                                ),
                              );
                            }),
                            12.toHeight,
                            Container(
                              decoration: BoxDecoration(
                                color: context.dProvider.whiteColor,
                                borderRadius: BorderRadius.circular(16),
                                border: Border.all(color: context.dProvider.black8.withOpacity(0.5)),
                              ),
                              child: ProfileMenuTile(
                                title: LocalKeys.signOut,
                                svg: SvgAssets.logout,
                                onPress: () {
                                  Alerts().confirmationAlert(
                                    context: context,
                                    title: LocalKeys.areYouSure,
                                    buttonText: LocalKeys.signOut,
                                    onConfirm: () async {
                                      await Provider.of<SignOutService>(context,
                                              listen: false)
                                          .trySignOut()
                                          .then((v) {
                                        if (v == true) {
                                          Provider.of<ProfileInfoService>(context,
                                                  listen: false)
                                              .reset();
                                          Provider.of<UserAddressService>(context,
                                                  listen: false)
                                              .reset();
                                          OnboardingViewModel.dispose;
                                          navigatorKey.currentState
                                              ?.pushNamedAndRemoveUntil(
                                                  SplashView.routeName,
                                                  (route) => false);
                                        }
                                      });
                                    },
                                  );
                                },
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
          );
        }),
      ],
    );
  }

  Widget _buildPromoteBanner(BuildContext context, ProfileInfoService pi) {
    final isPro = pi.profileInfoModel.data?.isPro == "yes";
    if (isPro) return const SizedBox.shrink();

    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        gradient: LinearGradient(
          colors: [
            context.dProvider.primaryColor,
            context.dProvider.primaryColor.withOpacity(0.8),
          ],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: context.dProvider.primaryColor.withOpacity(0.3),
            blurRadius: 10,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Row(
        children: [
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  "Profilini Öne Çıkar",
                  style: context.titleMedium?.copyWith(
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                  ),
                ),
                4.toHeight,
                Text(
                  "Daha fazla müşteriye ulaş ve kazancını artır!",
                  style: context.bodySmall?.copyWith(
                    color: Colors.white.withOpacity(0.9),
                  ),
                ),
                12.toHeight,
                ElevatedButton(
                  onPressed: () {
                    final ppm = PromotionPaymentViewModel.instance;
                    ppm.setId(pi.profileInfoModel.data?.id);
                    ppm.setType("profile");
                    context.toNamed(PromotionPaymentView.routeName);
                  },
                  style: ElevatedButton.styleFrom(
                    backgroundColor: Colors.white,
                    foregroundColor: context.dProvider.primaryColor,
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(8),
                    ),
                    padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                  ),
                  child: Text(
                    LocalKeys.promoteNow,
                    style: const TextStyle(fontWeight: FontWeight.bold),
                  ),
                ),
              ],
            ),
          ),
          const SizedBox(width: 12),
          Icon(
            Icons.rocket_launch_rounded,
            size: 60,
            color: Colors.white.withOpacity(0.3),
          ),
        ],
      ),
    );
  }
}

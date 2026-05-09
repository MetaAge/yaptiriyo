import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/helper/svg_assets.dart';
import 'package:xilancer/main.dart';
import 'package:xilancer/services/auth/sign_out_service.dart';
import 'package:xilancer/services/profile_info_service.dart';
import 'package:xilancer/services/user_mode_service.dart';
import 'package:xilancer/services/dynamics/dynamics_service.dart';
import 'package:xilancer/utils/components/alerts.dart';
import 'package:xilancer/view_models/change_password_view_model/change_password_view_model.dart';
import 'package:xilancer/view_models/onboarding_view_model/onboarding_view_model.dart';
import 'package:xilancer/views/change_password_view/change_password_view.dart';
import 'package:xilancer/views/profile_edit_view/profile_edit_view.dart';
import 'package:xilancer/views/sign_in_view/sign_in_view.dart';
import 'package:xilancer/views/support_ticket_list_view/support_ticket_list_view.dart';
import 'package:xilancer/views/profile_view/address_management_view.dart';
import 'package:xilancer/views/wallet_view/wallet_view.dart';
import 'package:xilancer/views/profile_view/saved_cards_view.dart';
import 'package:xilancer/services/user_address_service.dart';
import 'package:xilancer/views/profile_view/portfolio_management_view.dart';
import 'package:xilancer/views/subscription_view/subscription_view.dart';
import '../../profile_view/components/profile_menu_tile.dart';

class ProfileSettingMenuList extends StatelessWidget {
  const ProfileSettingMenuList({super.key});

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.fromLTRB(20, 32, 20, 0),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          _buildSectionTitle(context, "Hesap Ayarları"),
          _buildSectionCard(context, [
            ProfileMenuTile(
              title: LocalKeys.editProfile,
              svg: SvgAssets.userSquare,
              onPress: () {
                context.toNamed(ProfileEditView.routeName);
              },
            ),
            Consumer<UserModeService>(builder: (context, um, child) {
              return um.isFreelancer
                  ? const SizedBox()
                  : ProfileMenuTile(
                      title: LocalKeys.myAddresses,
                      svg: SvgAssets.location,
                      onPress: () {
                        context.toNamed(AddressManagementView.routeName);
                      },
                    );
            }),
            Consumer<UserModeService>(builder: (context, um, child) {
              return um.isClient
                  ? const SizedBox()
                  : ProfileMenuTile(
                      title: LocalKeys.portfolio,
                      svg: SvgAssets.gallery,
                      onPress: () {
                        context.toNamed(PortfolioManagementView.routeName);
                      },
                    );
            }),
            ProfileMenuTile(
              title: LocalKeys.wallet,
              svg: SvgAssets.wallet,
              onPress: () {
                context.toNamed(WalletView.routeName);
              },
            ),
            ProfileMenuTile(
              title: LocalKeys.savedCardsLabel,
              svg: SvgAssets.wallet,
              onPress: () {
                context.toNamed(SavedCardsView.routeName);
              },
            ),
            Consumer<UserModeService>(builder: (context, um, child) {
              return um.isFreelancer
                  ? ProfileMenuTile(
                      title: LocalKeys.subscription,
                      svg: SvgAssets.wallet,
                      onPress: () {
                        context.toNamed(SubscriptionView.routeName);
                      },
                    )
                  : const SizedBox();
            }),
          ]),
          24.toHeight,
          _buildSectionTitle(context, "Güvenlik & Destek"),
          _buildSectionCard(context, [
            ProfileMenuTile(
              title: LocalKeys.changePassword,
              svg: SvgAssets.lock,
              onPress: () {
                ChangePasswordViewModel.dispose;
                context.toNamed(ChangePasswordView.routeName);
              },
            ),
            ProfileMenuTile(
              title: LocalKeys.supportTicket,
              svg: SvgAssets.support,
              onPress: () {
                context.toNamed(SupportTicketListView.routeName);
              },
            ),
          ]),
          24.toHeight,
          _buildSectionTitle(context, "Uygulama Ayarları"),
          _buildSectionCard(context, [
            Consumer<DynamicsService>(builder: (context, dynamicProv, child) {
              return Container(
                color: context.dProvider.whiteColor,
                child: SwitchListTile(
                  contentPadding: const EdgeInsets.symmetric(horizontal: 20),
                  title: Text(
                    LocalKeys.darkMode,
                    style: context.titleMedium?.bold5
                        .copyWith(color: context.dProvider.black2, fontSize: 15),
                  ),
                  value: dynamicProv.isDarkMode,
                  activeColor: context.dProvider.primaryColor,
                  onChanged: (val) {
                    dynamicProv.toggleDarkMode();
                  },
                ),
              );
            }),
            Consumer<UserModeService>(builder: (context, um, child) {
              return ProfileMenuTile(
                title: um.isClient
                    ? LocalKeys.switchToFreelancerMode
                    : LocalKeys.switchToClientMode,
                svg: SvgAssets.home,
                iconColor: context.dProvider.secondaryColor,
                onPress: () {
                  um.toggleMode();
                  um.onModeChange(context);
                  OnboardingViewModel.instance.setNavIndex(0);
                  "${LocalKeys.switchedTo} ${um.isFreelancer ? LocalKeys.freelancer : LocalKeys.customer}"
                      .showToast();
                },
              );
            }),
            ProfileMenuTile(
              title: LocalKeys.signOut,
              svg: SvgAssets.logout,
              iconColor: context.dProvider.warningColor,
              onPress: () {
                Alerts().confirmationAlert(
                  context: context,
                  title: LocalKeys.areYouSure,
                  buttonText: LocalKeys.signOut,
                  onConfirm: () async {
                    await Provider.of<SignOutService>(context, listen: false)
                        .trySignOut()
                        .then((v) {
                      if (v == true) {
                        Provider.of<ProfileInfoService>(context, listen: false)
                            .reset();
                        Provider.of<UserAddressService>(context, listen: false)
                            .reset();
                        Navigator.of(context).pop();
                        navigatorKey.currentState?.pushAndRemoveUntil(
                            MaterialPageRoute(
                                builder: (_) => const SignInView()),
                            (route) => false);
                      }
                    });
                  },
                );
              },
            ),
          ]),
        ],
      ),
    );
  }

  Widget _buildSectionTitle(BuildContext context, String title) {
    return Padding(
      padding: const EdgeInsets.only(left: 4, bottom: 12),
      child: Text(
        title.toUpperCase(),
        style: context.titleSmall?.copyWith(
          color: context.dProvider.black5,
          letterSpacing: 1.2,
          fontWeight: FontWeight.bold,
          fontSize: 12,
        ),
      ),
    );
  }

  Widget _buildSectionCard(BuildContext context, List<Widget> children) {
    return Container(
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: BorderRadius.circular(20),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.03),
            blurRadius: 10,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(20),
        child: Column(children: children),
      ),
    );
  }
}

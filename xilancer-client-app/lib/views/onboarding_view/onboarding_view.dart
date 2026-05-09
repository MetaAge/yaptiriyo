import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/services/user_mode_service.dart';
import 'package:xilancer/views/home_drawer_view/home_drawer_view.dart';
import 'package:xilancer/views/my_orders_view/my_orders_and_offers_view.dart';
import 'package:xilancer/views/my_orders_view/my_orders_view.dart';
import '/view_models/onboarding_view_model/onboarding_view_model.dart';
import '/views/chat_list_view/chat_list_view.dart';
import '/views/home_view/home_view.dart';
import 'package:xilancer/views/profile_settings_view/components/profile_unified_body.dart';
import 'package:xilancer/views/profile_view/components/profile_view_app_bar.dart';
import '../my_projects/my_projects_view.dart';
import '../bookmark_view/bookmark_view.dart';
import 'components/onboarding_bottom_nav.dart';

class OnboardingView extends StatelessWidget {
  static const routeName = "landing";
  const OnboardingView({super.key});

  @override
  Widget build(BuildContext context) {
    final ov = OnboardingViewModel.instance;
    return Consumer<UserModeService>(builder: (context, um, child) {
      final widgets = um.isFreelancer
          ? [
              const HomeView(),
              const ChatListView(),
              const MyOrdersView(),
              const MyProjects(),
              const Column(
                children: [
                  ProfileViewAppBar(),
                  Expanded(child: ProfileUnifiedBody()),
                ],
              ),
            ]
          : [
              const HomeView(),
              const ChatListView(),
              const MyOrdersAndOffersView(),
              const BookmarkView(),
              const Column(
                children: [
                  ProfileViewAppBar(),
                  Expanded(child: ProfileUnifiedBody()),
                ],
              ),
            ];
        return PopScope(
        canPop: false,
        onPopInvoked: (didPop) => ov.willPopFunction(),
        child: Scaffold(
          extendBody: true,
          resizeToAvoidBottomInset: true,
          key: ov.scaffoldKey,
          drawer: ValueListenableBuilder(
            valueListenable: ov.currentIndex,
            builder: (context, value, child) => value != 0
                ? const SizedBox(
                    width: 0,
                  )
                : Drawer(
                    backgroundColor: context.dProvider.black9,
                    surfaceTintColor: context.dProvider.black9,
                    child: const HomeDrawerView(),
                  ),
          ),
          body: ValueListenableBuilder(
            valueListenable: ov.currentIndex,
            builder: (context, value, child) => widgets[value],
          ),
          bottomNavigationBar: context.mediaQuery.viewInsets.bottom > 0
              ? null
              : const OnboardingNavBar(),
        ),
      );
    });
  }
}

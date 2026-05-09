import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:badges/badges.dart' as badges;
import 'package:xilancer/services/message_notification_count_service.dart';
import '../../../helper/local_keys.g.dart';
import '../../../helper/svg_assets.dart';
import '/helper/extension/context_extension.dart';
import '/helper/extension/string_extension.dart';
import '/view_models/onboarding_view_model/onboarding_view_model.dart';

import 'package:xilancer/services/user_mode_service.dart';

class OnboardingNavBar extends StatelessWidget {
  const OnboardingNavBar({super.key});

  @override
  Widget build(BuildContext context) {
    final ov = OnboardingViewModel.instance;
    return Consumer<UserModeService>(
      builder: (context, um, child) {
        return ValueListenableBuilder(
          valueListenable: ov.currentIndex,
          builder:
              (context, value, child) => Container(
                margin: const EdgeInsets.fromLTRB(20, 0, 20, 24),
                decoration: BoxDecoration(
                  color: context.dProvider.whiteColor.withOpacity(0.85),
                  borderRadius: BorderRadius.circular(30),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.1),
                      blurRadius: 20,
                      offset: const Offset(0, 10),
                    ),
                  ],
                  border: Border.all(color: Colors.white.withOpacity(0.2)),
                ),
                child: ClipRRect(
                  borderRadius: BorderRadius.circular(30),
                  child: Container(
                    height: 70,
                    padding: const EdgeInsets.symmetric(horizontal: 12),
                  child: Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      navBarItem(
                        context,
                        LocalKeys.home,
                        SvgAssets.home,
                        SvgAssets.homeBold,
                        0,
                        ov,
                      ),
                      Consumer<MessageNotificationCountService>(
                        builder: (context, mnc, child) {
                          return navBarItem(
                            context,
                            LocalKeys.inbox,
                            SvgAssets.message,
                            SvgAssets.messageBold,
                            1,
                            ov,
                            badgeCount: mnc.messageCount,
                          );
                        },
                      ),
                      navBarItem(
                        context,
                        um.isFreelancer ? LocalKeys.myOrder : LocalKeys.myOrder,
                        SvgAssets.clipboardText,
                        SvgAssets.clipboardTextBold,
                        2,
                        ov,
                      ),
                      um.isFreelancer
                          ? navBarItem(
                              context,
                              LocalKeys.myProjects, // "Hizmetlerim"
                              SvgAssets.clipboardText,
                              SvgAssets.clipboardTextBold,
                              3,
                              ov)
                          : navBarItem(
                              context,
                              LocalKeys.bookmark, // "Yer İşaretleri"
                              SvgAssets.bookmark,
                              SvgAssets.bookmarkBold,
                              3,
                              ov),
                      /*navBarItem(
                            context,
                            LocalKeys.bookmark, // işlerim için myJobs yap
                            SvgAssets.bookmark,
                            SvgAssets.bookmarkBold,
                            3,
                            ov,
                            badgeCount: bd.bookmarkList.length,
                          ),*/
                      navBarItem(
                        context,
                        LocalKeys.profile,
                        SvgAssets.user,
                        SvgAssets.userBold,
                        4,
                        ov,
                      ),
                    ],
                  ),
                ),
              ),
            ),
        );
      },
    );
  }

  navBarItem(
    BuildContext context,
    String label,
    String iconNormal,
    String iconFilled,
    int index,
    ov, {
    badgeCount = 0,
  }) {
    final selected = index == ov.currentIndex.value;
    return InkWell(
      onTap: () {
        HapticFeedback.mediumImpact();
        ov.setNavIndex(index);
      },
      child: Container(
        height: 44,
        alignment: Alignment.center,
        margin: const EdgeInsets.symmetric(horizontal: 2),
        padding: EdgeInsets.symmetric(
          horizontal: selected ? 12.0 : 8.0,
          vertical: 4,
        ),
        decoration: selected
            ? BoxDecoration(
                  borderRadius: BorderRadius.circular(25),
                  color: context.dProvider.primaryColor.withOpacity(0.12),
                  boxShadow: [
                    BoxShadow(
                      color: context.dProvider.primaryColor.withOpacity(0.1),
                      blurRadius: 8,
                      offset: const Offset(0, 4),
                    ),
                  ],
                )
                : null,
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            (selected
                ? iconFilled.toSVGSized(
                  24,
                  color: context.dProvider.primaryColor,
                )
                : badges.Badge(
                  position: badges.BadgePosition.topEnd(),
                  badgeContent: Text(
                    "$badgeCount",
                    style: context.titleSmall?.copyWith(
                      color: context.dProvider.whiteColor,
                    ),
                  ),
                  showBadge: badgeCount > 0,
                  child: iconNormal.toSVGSized(24),
                )),
            if (selected) 8.toWidth,
            if (selected)
              FittedBox(
                child: Text(
                  label,
                  style:
                      context.titleSmall
                          ?.copyWith(color: context.dProvider.primaryColor)
                          .bold6,
                ),
              ),
          ],
        ),
      ),
    );
  }
}

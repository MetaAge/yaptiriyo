import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/services/profile_info_service.dart';
import 'package:xilancer/utils/components/custom_refresh_indicator.dart';
import 'profile_setting_info.dart';
import 'profile_setting_menu_list.dart';

import 'package:xilancer/views/account_skeleton/account_skeleton.dart';

class ProfileUnifiedBody extends StatelessWidget {
  const ProfileUnifiedBody({super.key});

  @override
  Widget build(BuildContext context) {
    return Consumer<ProfileInfoService>(builder: (context, pi, child) {
      if (pi.profileInfoModel.data == null) {
        return const AccountSkeleton();
      }
      return CustomRefreshIndicator(
        onRefresh: () async {
          await Provider.of<ProfileInfoService>(context, listen: false)
              .fetchProfileInfo();
        },
        child: ListView(
          physics: const AlwaysScrollableScrollPhysics(),
          padding: EdgeInsets.zero,
          children: [
            const ProfileSettingInfo(),
            const ProfileSettingMenuList(),
            120.toHeight,
          ],
        ),
      );
    });
  }
}

import 'package:flutter/material.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/views/profile_settings_view/components/profile_unified_body.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';

class ProfileSettingsView extends StatelessWidget {
  static const routeName = 'profile_settings_view';
  const ProfileSettingsView({super.key});
  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          leading: const NavigationPopIcon(),
          title: Text(LocalKeys.profile),
        ),
        body: const ProfileUnifiedBody());
  }
}

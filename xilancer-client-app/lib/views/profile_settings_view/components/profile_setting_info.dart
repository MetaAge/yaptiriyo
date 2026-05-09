import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/profile_info_service.dart';
import 'profile_info_avatar.dart';
import '/helper/extension/context_extension.dart';

class ProfileSettingInfo extends StatelessWidget {
  const ProfileSettingInfo({super.key});

  @override
  Widget build(BuildContext context) {
    return Consumer<ProfileInfoService>(builder: (context, pi, child) {
      return Container(
        width: double.infinity,
        decoration: BoxDecoration(
          color: context.dProvider.whiteColor,
        ),
        child: Column(
          children: [
            Stack(
              clipBehavior: Clip.none,
              alignment: Alignment.center,
              children: [
                // Curved Background
                Container(
                  height: 140,
                  width: double.infinity,
                  decoration: BoxDecoration(
                    gradient: LinearGradient(
                      begin: Alignment.topLeft,
                      end: Alignment.bottomRight,
                      colors: [
                        context.dProvider.primaryColor,
                        context.dProvider.primaryColor.withOpacity(0.8),
                      ],
                    ),
                    borderRadius: const BorderRadius.vertical(bottom: Radius.circular(40)),
                  ),
                ),
                // Decorative circles
                Positioned(
                  top: -20,
                  right: -20,
                  child: CircleAvatar(
                    radius: 50,
                    backgroundColor: Colors.white.withOpacity(0.1),
                  ),
                ),
                Positioned(
                  top: 40,
                  left: -30,
                  child: CircleAvatar(
                    radius: 40,
                    backgroundColor: Colors.white.withOpacity(0.05),
                  ),
                ),
                // Profile Avatar
                Positioned(
                  bottom: -50,
                  child: Container(
                    padding: const EdgeInsets.all(5),
                    decoration: BoxDecoration(
                      color: context.dProvider.whiteColor,
                      shape: BoxShape.circle,
                      boxShadow: [
                        BoxShadow(
                          color: Colors.black.withOpacity(0.12),
                          blurRadius: 20,
                          offset: const Offset(0, 8),
                        ),
                      ],
                    ),
                    child: const ProfileInfoAvatar(),
                  ),
                ),
              ],
            ),
            const SizedBox(height: 60),
            Text(
              (pi.profileInfoModel.data?.firstName ?? LocalKeys.freelancer) +
                  (" ${pi.profileInfoModel.data?.lastName ?? ""}"),
              style: context.titleLarge?.bold6.copyWith(
                color: context.dProvider.black2,
                fontSize: 24,
                letterSpacing: -0.5,
              ),
            ),
            const SizedBox(height: 6),
            Container(
              padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
              decoration: BoxDecoration(
                color: context.dProvider.black9,
                borderRadius: BorderRadius.circular(10),
              ),
              child: Text(
                pi.profileInfoModel.data?.email ?? "",
                style: context.bodyMedium?.copyWith(
                  color: context.dProvider.black5,
                  fontWeight: FontWeight.w500,
                  fontSize: 13,
                ),
              ),
            ),
            const SizedBox(height: 10),
          ],
        ),
      );
    });
  }
}

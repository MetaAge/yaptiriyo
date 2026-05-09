import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/services/profile_details_service.dart';
import 'package:xilancer/utils/components/profile_pro_tag.dart';
import 'package:xilancer/views/chat_list_view/components/chat_tile_avatar.dart';
import 'package:xilancer/views/profile_details_view/components/freelancer_level_tag.dart';

class ProfileNameInfos extends StatelessWidget {
  const ProfileNameInfos({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return Consumer<ProfileDetailsService>(builder: (context, pd, child) {
      final user = pd.profileDetails.user;
      return Row(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Expanded(
            flex: 4,
            child: ChatTileAvatar(
                imageUrl: (user?.cloudImage ?? "").isNotEmpty
                    ? user!.cloudImage!
                    : "${pd.profileDetails.profileImagePath}/${user?.image}",
                name: "${user?.firstName ?? ""} ${user?.lastName ?? ""}",
                size: 60.0),
          ),
          const Expanded(
            flex: 1,
            child: SizedBox(),
          ),
          Expanded(
            flex: 16,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Wrap(
                  spacing: 6,
                  crossAxisAlignment: WrapCrossAlignment.center,
                  children: [
                    if (pd.profileDetails.freelancerLevel?.levelTitle != null)
                      FreelancerLevelTag(
                          levelTitle:
                              pd.profileDetails.freelancerLevel!.levelTitle!),
                    if (pd.profileDetails.isPro)
                      ProfileProTag(
                        isPro: true,
                        proExpDate: DateTime.now().add(Duration(days: 1)),
                      ),
                  ],
                ),
                if (pd.profileDetails.freelancerLevel?.levelTitle != null ||
                    pd.profileDetails.isPro)
                  4.toHeight,
                Text(
                  "${user?.firstName ?? ""} ${user?.lastName ?? ""}",
                  style: context.titleMedium?.bold6,
                ),
                if (user?.userIntroduction?.title != null) ...[
                  4.toHeight,
                  Text(
                    user?.userIntroduction?.title ?? "",
                    style: context.titleSmall
                        ?.copyWith(color: context.dProvider.black5),
                  )
                ],
                8.toHeight,
                Container(
                  padding:
                      const EdgeInsets.symmetric(horizontal: 8, vertical: 2),
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(20),
                    color: context.dProvider.yellowColor.withOpacity(0.10),
                  ),
                  child: FittedBox(
                    child: Row(
                      children: [
                        Icon(
                          Icons.star_rounded,
                          color: context.dProvider.yellowColor,
                          size: 20,
                        ),
                        4.toWidth,
                        Text(
                          "${pd.profileDetails.avgRating ?? 0} (${pd.profileDetails.totalRating ?? 0})",
                          style: context.titleSmall
                              ?.copyWith(color: context.dProvider.yellowColor)
                              .bold6,
                        ),
                      ],
                    ),
                  ),
                ),
              ],
            ),
          ),
        ],
      );
    });
  }
}

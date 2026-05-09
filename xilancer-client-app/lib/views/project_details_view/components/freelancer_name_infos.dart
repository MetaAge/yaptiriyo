import 'package:badges/badges.dart' as badges;
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

import '../../../helper/local_keys.g.dart';
import '../../../helper/pusher_helper.dart';
import '../../../helper/svg_assets.dart';
import '../../../models/project_details_model.dart';
import '../../../services/chat_list_service.dart';
import '../../../services/profile_info_service.dart';
import '../../../services/project_details_service.dart';
import '../../../views/chat_list_view/components/chat_tile_avatar.dart';
import '../../../views/profile_details_view/profile_details_view.dart';
import '../../conversation_view/conversation_view.dart';
import 'freelancer_level_tag.dart';
import 'profile_pro_tag.dart';
import 'profile_premium_tag.dart';



class FreelancerNameInfos extends StatelessWidget {
  final ProjectCreator? userDetails;
  final projectId;
  const FreelancerNameInfos({
    super.key,
    this.userDetails,
    this.projectId,
  });

  @override
  Widget build(BuildContext context) {
    final pdProvider =
        Provider.of<ProjectDetailsService>(context, listen: false);
    final pi = Provider.of<ProfileInfoService>(context, listen: false);
    final project = pdProvider.projectDetailsModel[projectId.toString()];
    final freelancerRating = project?.freelancerRating ?? 0;
    final freelancerTotalRating = project?.freelancerTotalRating ?? 0;
    final completeOrdersCount = project?.completeOrdersCount ?? 0;
    final isFreelancerActive = DateTime.now()
            .difference(
                project?.projectDetails?.projectCreator?.checkOnlineStatus ??
                    DateTime(2022))
            .inMinutes
            .abs() <
        2;
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Expanded(
          flex: 4,
          child: badges.Badge(
            badgeStyle: const badges.BadgeStyle(badgeColor: Colors.transparent),
            position: badges.BadgePosition.bottomEnd(bottom: 0, end: 4),
            badgeContent: Container(
              padding: const EdgeInsets.all(3),
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: context.dProvider.whiteColor,
              ),
              child: CircleAvatar(
                radius: 6,
                backgroundColor: isFreelancerActive
                    ? const Color(0xFF22C55E)
                    : context.dProvider.black3,
              ),
            ),
            child: ChatTileAvatar(
                imageUrl: userDetails?.freelancerCloudImage ??
                    "$userProfilePath/${userDetails?.image}",
                name:
                    "${userDetails?.firstName ?? ""} ${userDetails?.lastName ?? ""}",
                size: 60.0),
          ),
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
              ...[
                Wrap(
                  spacing: 6,
                  crossAxisAlignment: WrapCrossAlignment.center,
                  children: [
                    if (project?.freelancerLevel?.levelTitle != null)
                      FreelancerLevelTag(
                          levelTitle: project?.freelancerLevel?.levelTitle),
                    if (project?.isFreelancerPro ?? false)
                      ProfileProTag(
                        isPro: true,
                      ),
                    if (project?.projectDetails?.projectCreator?.isProTier ?? false)
                      ProfileProTag(isPro: true),
                    if (project?.projectDetails?.projectCreator?.isPremiumTier ?? false)
                      ProfilePremiumTag(isPremium: true),
                  ],
                ),

                if (project?.freelancerLevel?.levelTitle != null ||
                    (project?.isFreelancerPro ?? false) ||
                    (project?.projectDetails?.projectCreator?.isProTier ?? false) ||
                    (project?.projectDetails?.projectCreator?.isPremiumTier ?? false))
                  8.toHeight

              ],
              Text(
                "${userDetails?.firstName ?? ""} ${userDetails?.lastName ?? ""}",
                style: context.titleMedium?.bold6,
              ),
              4.toHeight,
              if (userDetails?.userIntroduction?.title != null) ...[
                Text(
                  userDetails?.userIntroduction?.title ?? "",
                  style: context.titleSmall
                      ?.copyWith(color: context.dProvider.black5, fontSize: 13),
                ),
                8.toHeight,
              ],
              Wrap(
                runSpacing: 10,
                spacing: 10,
                children: [
                  if (freelancerTotalRating > 0)
                    GestureDetector(
                      onTap: () {
                        final userActiveStatus = DateTime.now()
                                .difference(project?.projectDetails
                                        ?.projectCreator?.checkOnlineStatus ??
                                    DateTime(2022))
                                .inMinutes
                                .abs() <
                            2;
                        context.toPage(ProfileDetailsView(
                          username: userDetails?.username,
                          userActiveStatus: userActiveStatus,
                          scrollToReviews: true,
                        ));
                      },
                      child: Container(
                        padding: const EdgeInsets.symmetric(
                            horizontal: 10, vertical: 6),
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(8),
                          color: const Color(0xFFFFB800).withOpacity(0.12),
                          border: Border.all(color: const Color(0xFFFFB800).withOpacity(0.2)),
                        ),
                        child: Row(
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            const Icon(
                              Icons.star_rounded,
                              color: Color(0xFFFFB800),
                              size: 18,
                            ),
                            4.toWidth,
                            Text(
                              "$freelancerRating ($freelancerTotalRating)",
                              style: context.bodySmall
                                  ?.copyWith(
                                      color: const Color(0xFFFFB800))
                                  .bold6,
                            ),
                          ],
                        ),
                      ),
                    ),
                  if (completeOrdersCount > 0)
                    Container(
                      padding: const EdgeInsets.symmetric(
                          horizontal: 10, vertical: 6),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(8),
                        color: const Color(0xFF22C55E).withOpacity(0.12),
                      ),
                      child: Text(
                        "$completeOrdersCount ${LocalKeys.ordersCompleted}",
                        style: context.bodySmall
                            ?.copyWith(color: const Color(0xFF22C55E))
                            .bold6,
                      ),
                    ),
                ],
              ),
              20.toHeight,
              Row(
                children: [
                  Expanded(
                    child: ElevatedButton(
                        style: ElevatedButton.styleFrom(
                          backgroundColor: context.dProvider.primaryColor,
                          foregroundColor: context.dProvider.whiteColor,
                          elevation: 0,
                          shape: RoundedRectangleBorder(
                            borderRadius: BorderRadius.circular(12),
                          ),
                          padding: const EdgeInsets.symmetric(vertical: 14),
                        ),
                        onPressed: () {
                          final userActiveStatus = DateTime.now()
                                  .difference(project?.projectDetails
                                          ?.projectCreator?.checkOnlineStatus ??
                                      DateTime(2022))
                                  .inMinutes
                                  .abs() <
                              2;
                          context.toPage(ProfileDetailsView(
                            username: userDetails?.username,
                            userActiveStatus: userActiveStatus,
                          ));
                        },
                        child: Text(LocalKeys.viewProfile, style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 15))),
                  ),
                  16.toWidth,
                  if (pi.profileInfoModel.data != null &&
                      pi.profileInfoModel.data!.id.toString() !=
                          userDetails?.id.toString())
                    InkWell(
                        onTap: () {
                          final profileInfo = pi.profileInfoModel.data!;
                          Provider.of<ChatListService>(context, listen: false)
                              .setChatRead(project?.chatInfo?.id);

                          PusherHelper().connectToPusher(
                              context,
                              profileInfo.id,
                              project?.projectDetails?.projectCreator?.id);
                          context
                              .toNamed(ConversationView.routeName, arguments: [
                            project?.chatInfo?.id ?? "",
                            "${project?.projectDetails?.projectCreator?.firstName} ${project?.projectDetails?.projectCreator?.lastName}",
                            "$userProfilePath/${userDetails?.image}",
                            project?.projectDetails?.projectCreator?.id
                          ]);
                        },
                        child: Container(
                          padding: const EdgeInsets.all(12),
                          decoration: BoxDecoration(
                            color: context.dProvider.primaryColor.withOpacity(0.08),
                            borderRadius: BorderRadius.circular(12),
                            border: Border.all(color: context.dProvider.primaryColor.withOpacity(0.1), width: 1.5),
                          ),
                          child: SvgAssets.messageBold.toSVGSized(24,
                              color: context.dProvider.primaryColor),
                        ))
                ],
              ),
            ],
          ),
        ),
      ],
    );
  }
}

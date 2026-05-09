import 'dart:math';

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/services/chat_list_service.dart';
import 'package:xilancer/view_models/conversation_view_model/conversation_view_model.dart';

import '../../../helper/pusher_helper.dart';
import '../../../utils/components/empty_spacer_helper.dart';
import '/helper/extension/context_extension.dart';
import 'package:xilancer/services/user_mode_service.dart';
import '/views/conversation_view/conversation_view.dart';
import 'chat_tile_avatar.dart';

class ChatTile extends StatelessWidget {
  final unRead;
  final name;
  final imageUrl;
  final uDate;
  final clientId;
  final freelancerId;
  final id;
  final isActive;
  final activityString;
  final unreadCount;

  const ChatTile({
    super.key,
    required this.id,
    required this.unRead,
    this.name,
    this.imageUrl,
    this.uDate,
    this.clientId,
    this.freelancerId,
    this.isActive,
    this.activityString,
    this.unreadCount,
  });

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () {
        final isFreelancer = UserModeService.instance.isFreelancer;
        final targetUserId = isFreelancer ? clientId : freelancerId;
        Provider.of<ChatListService>(context, listen: false).setChatRead(id);
        PusherHelper().connectToPusher(context, clientId, freelancerId);
        ConversationViewModel.instance.messageController.clear();
        context.toNamed(ConversationView.routeName,
            arguments: [id, name, imageUrl, targetUserId]);
      },
      child: Container(
        margin: const EdgeInsets.only(bottom: 12),
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(20),
          color: context.dProvider.whiteColor,
          boxShadow: [
            BoxShadow(
              color: Colors.black.withOpacity(0.04),
              blurRadius: 10,
              offset: const Offset(0, 4),
            ),
          ],
          border: Border.all(
            color: unRead ? context.dProvider.primaryColor.withOpacity(0.1) : Colors.transparent,
            width: 1.5,
          ),
        ),
        padding: const EdgeInsets.all(12),
        child: Row(
          children: [
            Stack(
              alignment: context.dProvider.textDirectionRight
                  ? Alignment.bottomLeft
                  : Alignment.bottomRight,
              children: [
                ChatTileAvatar(
                  name: name,
                  imageUrl: imageUrl,
                  color: context.dProvider.chatAvatarBGColors[
                      (int.tryParse(id.toString()) ??
                              Random().nextInt(1632)) %
                          context.dProvider.chatAvatarBGColors.length],
                ),
                Container(
                  padding: const EdgeInsets.all(3),
                  decoration: BoxDecoration(
                    color: context.dProvider.whiteColor,
                    shape: BoxShape.circle,
                  ),
                  child: CircleAvatar(
                    radius: 6,
                    backgroundColor: isActive != true
                        ? context.dProvider.black6
                        : context.dProvider.greenColor,
                  ),
                )
              ],
            ),
            const SizedBox(width: 14),
            Expanded(
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Row(
                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                    children: [
                      Expanded(
                        child: Text(
                          name ?? "----",
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                          style: context.titleMedium?.copyWith(
                            fontWeight: FontWeight.bold,
                            color: context.dProvider.black2,
                          ),
                        ),
                      ),
                      if (activityString != null)
                        Text(
                          activityString,
                          style: context.bodySmall?.copyWith(
                            fontSize: 11,
                            color: context.dProvider.black5,
                          ),
                        ),
                    ],
                  ),
                  const SizedBox(height: 4),
                  Row(
                    children: [
                      Expanded(
                        child: Text(
                          unRead ? "Yeni mesajınız var" : "Görüşmeyi görüntüle",
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                          style: context.bodySmall?.copyWith(
                            color: unRead ? context.dProvider.primaryColor : context.dProvider.black5,
                            fontWeight: unRead ? FontWeight.w600 : FontWeight.normal,
                          ),
                        ),
                      ),
                      if (unRead && unreadCount > 0)
                        Container(
                          padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                          decoration: BoxDecoration(
                            color: context.dProvider.primaryColor,
                            borderRadius: BorderRadius.circular(10),
                            boxShadow: [
                              BoxShadow(
                                color: context.dProvider.primaryColor.withOpacity(0.3),
                                blurRadius: 4,
                                offset: const Offset(0, 2),
                              )
                            ]
                          ),
                          child: Text(
                            unreadCount.toString(),
                            style: const TextStyle(
                              color: Colors.white,
                              fontSize: 10,
                              fontWeight: FontWeight.bold,
                            ),
                          ),
                        ),
                    ],
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

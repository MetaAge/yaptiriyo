import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/services/chat_list_service.dart';
import 'package:xilancer/services/user_mode_service.dart';

import '/helper/extension/context_extension.dart';
import '/helper/local_keys.g.dart';
import '/utils/components/custom_future_widget.dart';
import '/utils/components/custom_refresh_indicator.dart';
import '/views/chat_list_view/components/chat_tiles_shimmer.dart';
import '../../services/profile_info_service.dart';
import '../../utils/components/empty_widget.dart';
import '../../utils/components/scrolling_preloader.dart';
import '../../view_models/chat_list_view_model/chat_list_view_model.dart';
import '../account_skeleton/account_skeleton.dart';
import 'components/chat_tile.dart';

class ChatListView extends StatelessWidget {
  const ChatListView({super.key});

  @override
  Widget build(BuildContext context) {
    final clProvider = Provider.of<ChatListService>(context, listen: false);
    final clv = ChatListViewModel.instance;
    clv.scrollController.addListener(() {
      clv.tryLoadingMore(context);
    });
    return Column(
      children: [
        AppBar(
          leadingWidth: 0,
          leading: const SizedBox(),
          title: Text(
            LocalKeys.inbox,
            style: context.titleLarge?.bold6,
          ),
          elevation: 0,
          backgroundColor: context.dProvider.whiteColor,
        ),
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
          decoration: BoxDecoration(
            color: context.dProvider.whiteColor,
            boxShadow: [
              BoxShadow(
                color: Colors.black.withOpacity(0.03),
                blurRadius: 10,
                offset: const Offset(0, 4),
              ),
            ],
          ),
          child: Container(
            height: 52,
            padding: const EdgeInsets.symmetric(horizontal: 16),
            decoration: BoxDecoration(
              color: context.dProvider.black9,
              borderRadius: BorderRadius.circular(24),
              border: Border.all(color: context.dProvider.black8),
            ),
            child: TextField(
              decoration: InputDecoration(
                hintText: LocalKeys.searchProject,
                hintStyle: TextStyle(color: context.dProvider.black5, fontSize: 14),
                icon: Icon(Icons.search_rounded, color: context.dProvider.black4, size: 22),
                border: InputBorder.none,
              ),
              onChanged: (value) {
                // Implement search logic if supported by ChatListService
              },
            ),
          ),
        ),
        Consumer<ProfileInfoService>(builder: (context, pi, child) {
          return Expanded(
            child: pi.profileInfoModel.data == null
                ? Column(
                    children: [
                      const Expanded(child: AccountSkeleton()),
                      16.toHeight,
                    ],
                  )
                : CustomRefreshIndicator(
                    onRefresh: () async {
                      await clProvider.fetchChatList();
                    },
                    child: CustomFutureWidget(
                        function: clProvider.shouldAutoFetch
                            ? clProvider.fetchChatList()
                            : null,
                        shimmer: const ChatTileShimmer(),
                        child: Consumer<ChatListService>(
                            builder: (context, cl, child) {
                          return (cl.chatListModel.chatList?.chats?.length ??
                                      0) <
                                  1
                              ? EmptyWidget(
                                  title: LocalKeys.noConversationsToDisplay,
                                  subtitle: "Görüşmeye başlamak için yeni projeler keşfedin veya ilan verin.",
                                  buttonText: "Projeleri Keşfet",
                                  onButtonPressed: () {
                                    // Normally navigate to home or search, mapping to index logic.
                                    clv.tryLoadingMore(context); // dummy action or handle custom navigation
                                  },
                                )
                              : Scrollbar(
                                  controller: clv.scrollController,
                                  child: Container(
                                    color: context.dProvider.black9,
                                    padding: const EdgeInsets.only(bottom: 120, left: 16, right: 16, top: 12),
                                    child: ListView.separated(
                                        padding: EdgeInsets.zero,
                                        physics:
                                            const AlwaysScrollableScrollPhysics(),
                                        controller: clv.scrollController,
                                        itemBuilder: (context, index) {
                                          if ((cl.nextPage != null &&
                                                  !cl.nexLoadingFailed) &&
                                              index ==
                                                  cl.chatListModel.chatList!
                                                      .chats!.length) {
                                            return ScrollPreloader(
                                                loading: cl.nextPageLoading);
                                          }
                                          final chatItem = cl.chatListModel
                                              .chatList!.chats![index];
                                          final isFreelancer =
                                              UserModeService.instance.isFreelancer;
                                          final otherUser = isFreelancer
                                              ? chatItem.client
                                              : chatItem.freelancer;
                                          final otherUserId = isFreelancer
                                              ? chatItem.clientId
                                              : chatItem.freelancerId;
                                          return ChatTile(
                                              id: chatItem.id,
                                              clientId: chatItem.clientId,
                                              freelancerId: chatItem.freelancerId,
                                              unRead: isFreelancer
                                                  ? chatItem
                                                          .freelancerUnseenMsgCount >
                                                      0
                                                  : chatItem.clientUnseenMsgCount >
                                                      0,
                                              isActive: cl
                                                      .chatListModel.activeUsers
                                                      ?.contains(otherUserId
                                                          .toString()) ??
                                                  false,
                                              unreadCount: isFreelancer
                                                  ? chatItem
                                                      .freelancerUnseenMsgCount
                                                  : chatItem
                                                      .clientUnseenMsgCount,
                                              activityString: cl
                                                      .chatListModel.activityCheck[
                                                  otherUserId.toString()],
                                              name: otherUser == null
                                                  ? "----"
                                                  : "${otherUser.firstName} ${otherUser.lastName ?? ""}",
                                              imageUrl: otherUser?.cloudImage ??
                                                  "${cl.chatListModel.profileImagePath}/${(otherUser?.image).toString()}");
                                        },
                                        separatorBuilder: (context, index) =>
                                            const SizedBox(height: 4),

                                        itemCount: cl.chatListModel.chatList!
                                                .chats!.length +
                                            (cl.nextPage != null &&
                                                    !cl.nexLoadingFailed
                                                ? 1
                                                : 0)),
                                  ),
                                );
                        })),
                  ),
          );
        })
      ],
    );
  }

  delay() async {
    await Future.delayed(const Duration(seconds: 2));
  }
}

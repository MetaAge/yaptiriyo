import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/services/conversation_service.dart';
import 'package:xilancer/services/agora_call_service.dart';
import 'package:xilancer/utils/components/custom_future_widget.dart';
import 'package:xilancer/views/voice_call_view/voice_call_view.dart';

import 'package:xilancer/services/user_mode_service.dart';
import 'package:xilancer/views/conversation_view/components/send_offer_sheet.dart';

import '/views/conversation_view/components/conversations_input_box.dart';
import '../../helper/local_keys.g.dart';
import '../../services/message_notification_count_service.dart';
import '../../utils/components/navigation_pop_icon.dart';
import 'components/conversation_message_list.dart';
import 'components/conversation_skeleton.dart';

class ConversationView extends StatelessWidget {
  static const routeName = "conversation_view";
  const ConversationView({super.key});

  @override
  Widget build(BuildContext context) {
    final arguments = context.arguments;
    final id = arguments[0];
    final name = arguments[1];
    final image = arguments[2];
    final freelancerId = arguments[3];
    final cProvider = Provider.of<ConversationService>(context, listen: false);
    return Scaffold(
      backgroundColor: context.dProvider.black9,
      appBar: AppBar(
        leading: const NavigationPopIcon(),
        title: Text(name),
        actions: [
          // Voice call button
          IconButton(
            icon: Icon(Icons.phone,
                color: context.dProvider.primaryColor),
            onPressed: () => _startVoiceCall(context, name, image, freelancerId),
          ),
          Consumer<UserModeService>(
            builder: (context, userMode, child) {
              return userMode.isFreelancer
                  ? TextButton(
                      onPressed: () {
                        showModalBottomSheet(
                          context: context,
                          isScrollControlled: true,
                          backgroundColor: Colors.transparent,
                          builder: (context) => SendOfferSheet(clientId: freelancerId),
                        );
                      },
                      child: Text(
                        LocalKeys.customOffer,
                        style: context.titleSmall
                            ?.copyWith(color: context.dProvider.primaryColor)
                            .bold6,
                      ),
                    )
                  : const SizedBox();
            },
          ),
          const SizedBox(width: 10),
        ],
      ),
      body: Stack(
        children: [
          CustomFutureWidget(
              function: 1 == 1 ? cProvider.fetchConversationMessages(id) : null,
              shimmer: const ConversationSkeleton(),
              child:
                  Consumer<ConversationService>(builder: (context, cs, child) {
                Provider.of<MessageNotificationCountService>(context,
                        listen: false)
                    .fetchMN();
                return Column(
                  children: [
                    Expanded(
                        child: ConversationMessageList(
                      cs: cs,
                      name: name,
                      clientImage: image,
                    )),
                    ConversationInputBox(
                      clientId: freelancerId,
                    ),
                  ],
                );
              })),
        ],
      ),
    );
  }

  void _startVoiceCall(
      BuildContext context, String name, dynamic image, dynamic targetUserId) async {
    final callService =
        Provider.of<AgoraCallService>(context, listen: false);
    final result = await callService.initiateCall(
      int.parse(targetUserId.toString()),
    );

    if (result != null && context.mounted) {
      final profileImagePath = image is String ? image : null;
      Navigator.of(context).push(MaterialPageRoute(
        builder: (_) => VoiceCallView(
          callerName: name,
          callerImage: profileImagePath,
          isOutgoing: true,
        ),
      ));
    }
  }
}

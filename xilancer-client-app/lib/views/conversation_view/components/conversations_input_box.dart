import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/view_models/conversation_view_model/conversation_view_model.dart';
import 'package:xilancer/views/conversation_view/components/conversations_buttons.dart';

import '/helper/extension/context_extension.dart';
import '/helper/local_keys.g.dart';

class ConversationInputBox extends StatelessWidget {
  final clientId;
  const ConversationInputBox({super.key, this.clientId});

  @override
  Widget build(BuildContext context) {
    final cm = ConversationViewModel.instance;
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 12),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.05),
            blurRadius: 10,
            offset: const Offset(0, -4),
          ),
        ],
      ),
      child: SafeArea(
        child: Column(
          mainAxisSize: MainAxisSize.min,
          children: [
            Container(
              decoration: BoxDecoration(
                color: context.dProvider.black9,
                borderRadius: BorderRadius.circular(24),
                border: Border.all(color: context.dProvider.black8),
              ),
              padding: const EdgeInsets.symmetric(horizontal: 16),
              child: TextFormField(
                controller: cm.messageController,
                textInputAction: TextInputAction.newline,
                minLines: 1,
                maxLines: 5,
                decoration: InputDecoration(
                  hintText: '${LocalKeys.message}...',
                  hintStyle: TextStyle(color: context.dProvider.black6),
                  border: InputBorder.none,
                ),
              ),
            ),
            const SizedBox(height: 12),
            ConversationButtons(
              clientId: clientId,
            )
          ],
        ),
      ),
    );
  }
}

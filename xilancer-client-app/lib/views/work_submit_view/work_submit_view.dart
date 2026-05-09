import 'package:flutter/material.dart';
import 'package:flutter_summernote/flutter_summernote.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';

import '../../helper/local_keys.g.dart';
import '../../utils/components/custom_button.dart';
import '../../utils/components/field_label.dart';
import '../../utils/components/warning_widget.dart';
import '../../view_models/my_order_details_view_model/my_order_details_view_model.dart';
import '../my_order_details_view/components/job_attachment_select.dart';
import '../../customizations.dart';

class WorkSubmitView extends StatelessWidget {
  final orderId;
  final milestoneId;
  const WorkSubmitView({
    super.key,
    required this.orderId,
    required this.milestoneId,
  });

  @override
  Widget build(BuildContext context) {
    final odm = MyOrderDetailsViewModel.instance;
    return Scaffold(
      appBar: AppBar(
        leading: const NavigationPopIcon(),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 24),
        child: Container(
          padding: const EdgeInsets.all(24),
          decoration: BoxDecoration(
            borderRadius: BorderRadius.circular(16),
            color: context.dProvider.whiteColor,
            boxShadow: [
              BoxShadow(
                color: context.dProvider.blackColor.withOpacity(0.04),
                blurRadius: 20,
                offset: const Offset(0, 10),
              ),
            ],
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              WarningWidget(text: LocalKeys.orderSubmitWarning),
              24.toHeight,
              AttachmentSelect(
                selectedAttachment: odm.selectedFile,
                maxMBSize: 100,
                isRequired: false,
                allowedExtensions: supportedWorkFiles,
              ),
              FieldLabel(
                label: LocalKeys.description,
                isRequired: true,
              ),
              TextFormField(
                controller: odm.workSubmitDescController,
                maxLines: 12,
                minLines: 6,
                keyboardType: TextInputType.multiline,
                decoration: InputDecoration(
                  hintText: LocalKeys.enterDescription,
                  fillColor: context.dProvider.black9.withOpacity(0.4),
                  filled: true,
                  enabledBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(12),
                    borderSide: BorderSide(
                      color: context.dProvider.black8.withOpacity(0.5),
                      width: 1,
                    ),
                  ),
                  focusedBorder: OutlineInputBorder(
                    borderRadius: BorderRadius.circular(12),
                    borderSide: BorderSide(
                      color: context.dProvider.primaryColor,
                      width: 1.5,
                    ),
                  ),
                  contentPadding: const EdgeInsets.all(16),
                ),
                style: context.titleSmall?.copyWith(
                  color: context.dProvider.black3,
                  height: 1.5,
                ),
              ),
              32.toHeight,
              ValueListenableBuilder(
                valueListenable: odm.fileSubmitLoading,
                builder: (context, loading, child) => CustomButton(
                    onPressed: () {
                      odm.trySubmittingWork(context,
                          orderId: orderId, milestoneId: milestoneId);
                    },
                    btText: LocalKeys.submit,
                    isLoading: loading),
              ),
              12.toHeight,
            ],
          ),
        ),
      ),
    );
  }
}

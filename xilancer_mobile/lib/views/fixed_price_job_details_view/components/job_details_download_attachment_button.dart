import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart' as urlLauncher;
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

import '../../../helper/local_keys.g.dart';
import '../../../helper/svg_assets.dart';

class JobDetailsDownloadAttachmentButton extends StatelessWidget {
  final String? attachmentPath;
  final String? attachment;
  final bool isUsingCloud;
  const JobDetailsDownloadAttachmentButton(
      {super.key,
      required this.attachmentPath,
      required this.attachment,
      required this.isUsingCloud});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: () async {
        if (attachment == null || attachment == "" || attachmentPath == null) {
          LocalKeys.attachmentNotAvailable.showToast();
          return;
        }
        debugPrint("$attachmentPath/$attachment".toString());
        if (isUsingCloud) {
          if (!attachment!.contains("https://")) {
            await urlLauncher.launch("https://$attachment");
            return;
          }
          await urlLauncher.launch("$attachment");
          return;
        }
        await urlLauncher.launch("$attachmentPath/$attachment");
      },
      child: Container(
        padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 12),
        decoration: BoxDecoration(
          borderRadius: BorderRadius.circular(8),
          color: context.dProvider.black9,
        ),
        child: Row(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            SvgAssets.documentDownload
                .toSVGSized(18, color: context.dProvider.black5),
            6.toWidth,
            Text(
              LocalKeys.downloadAttachment,
              style: context.titleSmall?.bold
                  .copyWith(color: context.dProvider.black5),
            ),
          ],
        ),
      ),
    );
  }
}

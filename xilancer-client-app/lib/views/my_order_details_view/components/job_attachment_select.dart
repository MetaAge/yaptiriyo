import 'dart:io';

import 'package:file_picker/file_picker.dart';
import 'package:flutter/material.dart';
import 'package:path/path.dart';
import 'package:xilancer/helper/extension/int_extension.dart';

import '/helper/extension/context_extension.dart';
import '/helper/extension/string_extension.dart';
import '../../../helper/local_keys.g.dart';
import '../../../helper/svg_assets.dart';
import '../../../utils/components/field_label.dart';

class AttachmentSelect extends StatelessWidget {
  const AttachmentSelect({
    super.key,
    required this.selectedAttachment,
    this.maxMBSize,
    this.allowedExtensions,
    this.isRequired = false,
  });

  final ValueNotifier<File?> selectedAttachment;
  final num? maxMBSize;
  final bool isRequired;
  final List<String>? allowedExtensions;

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        FieldLabel(
          label: LocalKeys.attachFile,
          isRequired: isRequired,
        ),
        ValueListenableBuilder(
          valueListenable: selectedAttachment,
          builder: (context, value, child) {
            return InkWell(
              onTap: () async {
                if (value != null) {
                  selectedAttachment.value = null;
                  LocalKeys.fileRemoved.showToast();
                  return;
                }
                try {
                  FilePickerResult? file = await FilePicker.platform
                      .pickFiles(
                    allowedExtensions: allowedExtensions,
                    type: FileType.custom,
                  )
                      .onError((error, stackTrace) {
                    debugPrint(error.toString());
                    return null;
                  });
                  if (file?.paths.firstOrNull == null) {
                    return;
                  }
                  final File imageFile = File(file!.paths.first!);
                  num maxSize = 1024 * 1024 * (maxMBSize ?? 1); // 1MB
                  final num fileSize = await imageFile.length();

                  if (maxMBSize != null && fileSize > maxSize) {
                    // File size exceeds maxValue
                    LocalKeys.imageMustBeLessThen1Mb.showToast();
                    return;
                  }
                  selectedAttachment.value = File(file.files.first.path!);
                  LocalKeys.fileSelected.showToast();
                } catch (error) {
                  LocalKeys.fileSelectFailed.showToast();
                }
              },
              child: Container(
                height: 56,
                decoration: BoxDecoration(
                    color: context.dProvider.black9.withOpacity(0.4),
                    borderRadius: BorderRadius.circular(12),
                    border: Border.all(
                      color: context.dProvider.black8.withOpacity(0.5),
                    )),
                child: Row(
                  children: [
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 16),
                      child: SvgAssets.gallery.toSVG,
                    ),
                    Expanded(
                      child: Text(
                        value != null
                            ? basename(value.path)
                            : LocalKeys.noSelectedFile,
                        maxLines: 1,
                        overflow: TextOverflow.ellipsis,
                        style: context.titleSmall?.copyWith(
                          color: value != null
                              ? context.dProvider.black3
                              : context.dProvider.black5,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ),
                    Container(
                      height: 56,
                      width: context.width / 3.5,
                      alignment: Alignment.center,
                      decoration: BoxDecoration(
                          color: context.dProvider.primaryColor.withOpacity(0.05),
                          borderRadius: const BorderRadius.only(
                            topRight: Radius.circular(12),
                            bottomRight: Radius.circular(12),
                          ),
                          border: Border(
                            left: BorderSide(
                              color: context.dProvider.black8.withOpacity(0.5),
                            ),
                          )),
                      child: Text(
                        value != null
                            ? LocalKeys.clearFile
                            : LocalKeys.selectFile,
                        style: context.titleSmall?.copyWith(
                            fontWeight: FontWeight.bold,
                            color: context.dProvider.primaryColor),
                      ),
                    )
                  ],
                ),
              ),
            );
          },
        ),
        if (allowedExtensions != null) ...[
          4.toHeight,
          Text(
            LocalKeys.supportedFiles + allowedExtensions!.join(","),
            style:
                context.titleSmall?.copyWith(color: context.dProvider.black6),
          )
        ],
        const SizedBox(height: 16),
      ],
    );
  }
}

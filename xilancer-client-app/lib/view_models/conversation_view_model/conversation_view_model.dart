import 'dart:io';

import 'package:file_picker/file_picker.dart';
import 'package:image_picker/image_picker.dart';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/app_static_values.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/conversation_service.dart';

class ConversationViewModel {
  TextEditingController messageController = TextEditingController();
  ValueNotifier<File?> aFile = ValueNotifier(null);
  ValueNotifier<bool> loading = ValueNotifier(false);

  ScrollController scrollController = ScrollController();

  ConversationViewModel._init();
  static ConversationViewModel? _instance;
  static ConversationViewModel get instance {
    _instance ??= ConversationViewModel._init();
    return _instance!;
  }

  ConversationViewModel._dispose();
  static bool get dispose {
    _instance = null;
    return true;
  }

  void attachFile(BuildContext context) async {
    if (aFile.value != null) {
      aFile.value = null;
      LocalKeys.fileRemoved.showToast();
      return;
    }
    showModalBottomSheet(
      context: context,
      builder: (context) => Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          ListTile(
            leading: const Icon(Icons.image),
            title: Text(LocalKeys.gallery),
            onTap: () {
              Navigator.pop(context);
              pickFromGallery();
            },
          ),
          ListTile(
            leading: const Icon(Icons.camera_alt),
            title: Text(LocalKeys.camera),
            onTap: () {
              Navigator.pop(context);
              captureFromCamera();
            },
          ),
          ListTile(
            leading: const Icon(Icons.file_present),
            title: Text(LocalKeys.file),
            onTap: () {
              Navigator.pop(context);
              pickFromFile();
            },
          ),
          const SizedBox(height: 20),
        ],
      ),
    );
  }

  void pickFromGallery() async {
    final ImagePicker picker = ImagePicker();
    final XFile? image = await picker.pickImage(source: ImageSource.gallery);
    if (image != null) {
      debugPrint("Gallery image picked: ${image.path}");
      if (image.path.isNotEmpty) {
        aFile.value = File(image.path);
        LocalKeys.fileSelected.showToast();
      } else {
        debugPrint("Picked image path is empty");
      }
    }
  }

  void captureFromCamera() async {
    final ImagePicker picker = ImagePicker();
    final XFile? image = await picker.pickImage(source: ImageSource.camera);
    if (image != null) {
      debugPrint("Camera image captured: ${image.path}");
      if (image.path.isNotEmpty) {
        aFile.value = File(image.path);
        LocalKeys.fileSelected.showToast();
      } else {
        debugPrint("Captured image path is empty");
      }
    }
  }

  void pickFromFile() async {
    final file = await FilePicker.platform.pickFiles(
      allowMultiple: false,
      type: FileType.custom,
      allowedExtensions: supportedFileTypesInC,
    );
    if (file != null && file.files.isNotEmpty) {
      final path = file.files.first.path;
      debugPrint("File picked: $path");
      if (path != null && path.isNotEmpty) {
        aFile.value = File(path);
        LocalKeys.fileSelected.showToast();
      } else {
        debugPrint("Picked file path is null or empty");
      }
    }
  }

  trySendingMessage(BuildContext context, clientId) async {
    context.unFocus;
    if (messageController.text.isEmpty && aFile.value == null) {
      LocalKeys.pleaseWriteMessageOrSelectAFile.showToast();
      return;
    }
    loading.value = true;
    try {
      debugPrint("Sending message with file: ${aFile.value?.path}");
      final cProvider =
          Provider.of<ConversationService>(context, listen: false);
      final value = await cProvider.trySendingMessage(
          messageController.text, aFile.value, clientId);
      if (value == true) {
        messageController.clear();
        aFile.value = null;
      }
    } catch (e) {
      debugPrint("Error sending message: $e");
    } finally {
      loading.value = false;
    }
  }

  initPusher(BuildContext context) async {}

  tryLoadingMore(BuildContext context) async {
    try {
      final cs = Provider.of<ConversationService>(context, listen: false);
      final nextPage = cs.nextPage;
      final nextPageLoading = cs.nextPageLoading;

      if (scrollController.offset ==
              scrollController.position.maxScrollExtent &&
          !scrollController.position.outOfRange) {
        if (nextPage != null && !nextPageLoading) {
          cs.fetchNextPage();
          return;
        }
      }
    } catch (e) {}
  }
}

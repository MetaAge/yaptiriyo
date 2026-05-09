import 'dart:io';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'package:just_audio/just_audio.dart';
import 'package:path/path.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/user_mode_service.dart';

import '../data/network/network_api_services.dart';
import '../models/conversation_model.dart';

class ConversationService with ChangeNotifier {
  ConversationModel? _conversationModel;
  ConversationModel get conversationModel =>
      _conversationModel ?? ConversationModel();

  var token = "";

  var nextPage;

  bool nextPageLoading = false;

  bool nexLoadingFailed = false;

  bool get shouldAutoFetch => _conversationModel == null || token.isInvalid;

  fetchConversationMessages(conversationId) async {
    token = getToken;
    _conversationModel = null;
    var url = "${AppUrls.conversationUrl}/$conversationId";

    final responseData = await NetworkApiServices()
        .getApi(url, null, headers: acceptJsonAuthHeader);

    if (responseData != null) {
      final tempData = ConversationModel.fromJson(responseData);
      _conversationModel = tempData;
      nextPage = tempData.allMessage?.nextPageUrl;
      notifyListeners();
      return true;
    }
  }

  trySendingMessage(message, File? file, otherUserId) async {
    final url = AppUrls.messageSendUrl;
    final isFreelancer = UserModeService.instance.isFreelancer;
    var request = http.MultipartRequest('POST', Uri.parse(url));
    request.fields.addAll({
      isFreelancer ? 'client_id' : 'freelancer_id': otherUserId.toString(),
      'message': message ?? ""
    });
    debugPrint({
      isFreelancer ? 'client_id' : 'freelancer_id': otherUserId.toString(),
      'message': message ?? ""
    }.toString());
    if (file != null) {
      debugPrint("Attaching file to request. Path: ${file.path}");
      if (file.path.isNotEmpty) {
        request.files.add(await http.MultipartFile.fromPath("file", file.path,
            filename: basename(file.path)));
      } else {
        debugPrint("File path is empty, skipping attachment.");
      }
    }
    request.headers.addAll(acceptJsonAuthHeader);

    final responseData = await NetworkApiServices()
        .postWithFileApi(request, LocalKeys.sendMessage);

    if (responseData != null) {
      final userType = isFreelancer ? "2" : "1";
      final remoteMessage = responseData['message'];
      final messageId = remoteMessage is Map ? remoteMessage['id'] : null;

      final msgContent = (message != null && message.toString().isNotEmpty)
          ? message.toString()
          : null;

      _conversationModel?.allMessage?.data?.insert(
          0,
          Datum(
            id: messageId,
            fromUser: userType,
            message: Message(message: msgContent),
            file: file,
            createdAt: DateTime.now(),
          ));

      if (_conversationModel?.allMessage?.data == null) {
        _conversationModel = ConversationModel(
            allMessage: AllMessage(data: [
          Datum(
            id: messageId,
            fromUser: userType,
            message: Message(message: msgContent),
            file: file,
            createdAt: DateTime.now(),
          )
        ]));
      }
      try {
        final player = AudioPlayer();
        player
            .setAsset('assets/audios/chat1.mp3')
            .then((value) => player.play());
      } catch (e) {
        debugPrint("Audio play error: $e");
      }
      notifyListeners();
      return true;
    }
  }

  void addNewMessage(messageReceived) async {
    try {
      final player = AudioPlayer();
      await player.setAsset('assets/audios/chat.mp3');
      player.play();
    } catch (e) {}
    _conversationModel?.allMessage?.data
        ?.insert(0, Datum.fromJson(messageReceived));
    notifyListeners();
  }

  void fetchNextPage() async {
    token = getToken;
    if (nextPageLoading) return;
    nextPageLoading = true;
    notifyListeners();
    final responseData = await NetworkApiServices()
        .getApi(nextPage, LocalKeys.jobList, headers: commonAuthHeader);

    if (responseData != null) {
      final tempData = ConversationModel.fromJson(responseData);
      tempData.allMessage?.data?.forEach((element) {
        _conversationModel?.allMessage?.data?.add(element);
      });
      nextPage = tempData.allMessage?.nextPageUrl;
    } else {
      nexLoadingFailed = true;
      Future.delayed(const Duration(seconds: 1)).then((value) {
        nexLoadingFailed = false;
        notifyListeners();
      });
    }
    nextPageLoading = false;
    notifyListeners();
  }

  Future<bool> sendCustomOffer(Map<String, String> body) async {
    final url = AppUrls.sendCustomOfferUrl;
    final responseData = await NetworkApiServices()
        .postApi(body, url, LocalKeys.sendOffer, headers: acceptJsonAuthHeader);

    if (responseData != null) {
      notifyListeners();
      return true;
    }
    return false;
  }
}

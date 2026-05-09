import 'package:flutter/material.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/data/network/network_api_services.dart';
import 'package:xilancer/helper/app_urls.dart';
import 'package:xilancer/models/saved_card_model.dart';
import 'package:xilancer/helper/local_keys.g.dart';

class IyzicoCardService with ChangeNotifier {
  List<SavedCard> savedCards = [];
  bool isLoadingCards = false;

  Future<void> fetchSavedCards() async {
    isLoadingCards = true;
    notifyListeners();

    try {
      final responseData = await NetworkApiServices().getApi(
        AppUrls.iyzicoCardsUrl,
        "Fetch Saved Cards",
        headers: acceptJsonAuthHeader,
      );

      if (responseData != null && responseData['status'] == 'success') {
        final List cardsData = responseData['cards'] ?? [];
        savedCards = cardsData.map((e) => SavedCard.fromJson(e)).toList();
      }
    } catch (e) {
      debugPrint("Error fetching Iyzico saved cards: $e");
    }

    isLoadingCards = false;
    notifyListeners();
  }

  Future<bool> saveCard({
    required String cardHolderName,
    required String cardNumber,
    required String expireMonth,
    required String expireYear,
    String? cardAlias,
  }) async {
    final data = {
      'card_holder_name': cardHolderName,
      'card_number': cardNumber,
      'expire_month': expireMonth,
      'expire_year': expireYear,
      'card_alias': cardAlias ?? 'My Card',
    };

    final responseData = await NetworkApiServices().postApi(
      data,
      AppUrls.iyzicoSaveCardUrl,
      LocalKeys.save,
      headers: acceptJsonAuthHeader,
    );

    if (responseData != null && responseData['status'] == 'success') {
      await fetchSavedCards();
      return true;
    }
    return false;
  }

  Future<bool> deleteCard(String cardToken) async {
    final data = {
      'card_token': cardToken,
    };

    final responseData = await NetworkApiServices().postApi(
      data,
      AppUrls.iyzicoDeleteCardUrl,
      LocalKeys.delete,
      headers: acceptJsonAuthHeader,
    );

    if (responseData != null && responseData['status'] == 'success') {
      savedCards.removeWhere((card) => card.cardToken == cardToken);
      notifyListeners();
      return true;
    }
    return false;
  }
}

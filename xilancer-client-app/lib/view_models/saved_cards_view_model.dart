import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/services/iyzico_card_service.dart';
import 'package:xilancer/helper/local_keys.g.dart';

class SavedCardsViewModel {
  final TextEditingController cardNameController = TextEditingController();
  final TextEditingController cardNumberController = TextEditingController();
  final TextEditingController expireMonthController = TextEditingController();
  final TextEditingController expireYearController = TextEditingController();
  final TextEditingController cvcController = TextEditingController();

  ValueNotifier<bool> isLoading = ValueNotifier(false);

  SavedCardsViewModel._init();
  static SavedCardsViewModel? _instance;
  static SavedCardsViewModel get instance {
    _instance ??= SavedCardsViewModel._init();
    return _instance!;
  }

  static bool get dispose {
    _instance = null;
    return true;
  }

  void resetFields() {
    cardNameController.clear();
    cardNumberController.clear();
    expireMonthController.clear();
    expireYearController.clear();
    cvcController.clear();
  }

  Future<void> trySavingCard(BuildContext context) async {
    if (cardNameController.text.isEmpty ||
        cardNumberController.text.isEmpty ||
        expireMonthController.text.isEmpty ||
        expireYearController.text.isEmpty) {
      LocalKeys.pleaseProvideYourCardInformation.showToast();
      return;
    }

    isLoading.value = true;
    final iyzicoService = Provider.of<IyzicoCardService>(context, listen: false);
    final success = await iyzicoService.saveCard(
      cardHolderName: cardNameController.text,
      cardNumber: cardNumberController.text.replaceAll(' ', ''),
      expireMonth: expireMonthController.text,
      expireYear: expireYearController.text,
      cardAlias: cardNameController.text,
    );
    isLoading.value = false;

    if (success) {
      resetFields();
      if (context.mounted) Navigator.pop(context);
      LocalKeys.paymentSuccessful.showToast();
    }
  }

  void tryDeletingCard(BuildContext context, String cardToken) {
    final iyzicoService = Provider.of<IyzicoCardService>(context, listen: false);
    iyzicoService.deleteCard(cardToken).then((success) {
      if (success) {
        LocalKeys.fileRemoved.showToast();
      }
    });
  }
}

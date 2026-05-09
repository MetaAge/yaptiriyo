import 'package:flutter/material.dart';
import 'package:flutter_svg/flutter_svg.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/utils/components/field_with_label.dart';
import 'package:xilancer/utils/components/field_label.dart';
import 'package:xilancer/utils/components/custom_button.dart';

import '../../../services/iyzico_card_service.dart';
import '../../../view_models/place_order_view_model/place_order_view_model.dart';
import '../../../models/saved_card_model.dart';

class IyzicoCardForm extends StatefulWidget {
  const IyzicoCardForm({Key? key}) : super(key: key);

  @override
  State<IyzicoCardForm> createState() => _IyzicoCardFormState();
}

class _IyzicoCardFormState extends State<IyzicoCardForm> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final iyzicoService = context.read<IyzicoCardService>();
      iyzicoService.fetchSavedCards().then((_) {
        // Auto-select the first card if none is selected
        final pom = PlaceOrderViewViewModel.instance;
        if (iyzicoService.savedCards.isNotEmpty && pom.iyzicoSelectedCardToken.value == null) {
          pom.iyzicoSelectedCardToken.value = iyzicoService.savedCards.first.cardToken;
          pom.iyzicoCardUserKey.value = iyzicoService.savedCards.first.cardUserKey;
        }
        if (iyzicoService.savedCards.isNotEmpty) {
           pom.iyzicoUseSavedCard.value = true;
        } else {
           pom.iyzicoUseSavedCard.value = false;
        }
      });
    });
  }

  @override
  Widget build(BuildContext context) {
    final pom = PlaceOrderViewViewModel.instance;
    final iyzicoService = context.watch<IyzicoCardService>();

    return ValueListenableBuilder<bool>(
      valueListenable: pom.iyzicoUseSavedCard,
      builder: (context, useSavedCard, child) {
        return Container(
          decoration: BoxDecoration(
            color: context.dProvider.whiteColor,
            borderRadius: BorderRadius.circular(12),
            border: Border.all(color: context.dProvider.black8),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              // Header
              Padding(
                padding: const EdgeInsets.fromLTRB(16, 12, 16, 8),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(LocalKeys.cardInfo, style: context.titleMedium?.bold6),
                    if (iyzicoService.savedCards.isNotEmpty)
                      InkWell(
                        onTap: () => pom.iyzicoUseSavedCard.value = !useSavedCard,
                        child: Text(
                          useSavedCard ? LocalKeys.useNewCard : LocalKeys.payWithSavedCard,
                          style: context.titleSmall?.bold6.copyWith(color: context.dProvider.primaryColor),
                        ),
                      ),
                  ],
                ),
              ),
              const Divider(height: 1),
              
              Padding(
                padding: const EdgeInsets.all(16.0),
                child: useSavedCard && iyzicoService.savedCards.isNotEmpty
                    ? _buildSavedCardSelector(context, pom, iyzicoService)
                    : _buildNewCardForm(context, pom),
              ),
            ],
          ),
        );
      },
    );
  }

  Widget _buildSavedCardSelector(BuildContext context, PlaceOrderViewViewModel pom, IyzicoCardService iyzicoService) {
    return ValueListenableBuilder<String?>(
      valueListenable: pom.iyzicoSelectedCardToken,
      builder: (context, selectedToken, child) {
        SavedCard? selectedCard;
        try {
          selectedCard = iyzicoService.savedCards.firstWhere((c) => c.cardToken == selectedToken);
        } catch (e) {
          if (iyzicoService.savedCards.isNotEmpty) {
            selectedCard = iyzicoService.savedCards.first;
          }
        }

        return Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            InkWell(
              onTap: () {
                _showCardsBottomSheet(context, pom, iyzicoService, selectedToken);
              },
              child: Container(
                padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
                decoration: BoxDecoration(
                  color: context.dProvider.black9,
                  borderRadius: BorderRadius.circular(8),
                  border: Border.all(color: context.dProvider.black8),
                ),
                child: Row(
                  children: [
                    Expanded(
                      child: Text(
                        selectedCard != null
                            ? "${selectedCard.cardAlias ?? 'Kart'} - ${selectedCard.lastFourDigits ?? '****'}"
                            : LocalKeys.selectCard,
                        style: context.titleMedium?.copyWith(color: context.dProvider.black5),
                      ),
                    ),
                    const Icon(Icons.keyboard_arrow_down, color: Colors.grey),
                  ],
                ),
              ),
            ),
            12.toHeight,
            Row(
              children: [
                SizedBox(
                  height: 24,
                  width: 24,
                  child: Checkbox(
                    value: true,
                    onChanged: (val) {},
                    activeColor: context.dProvider.whiteColor,
                    checkColor: context.dProvider.primaryColor,
                    side: BorderSide(color: context.dProvider.black8),
                  ),
                ),
                8.toWidth,
                Text(LocalKeys.payWith3DSecure, style: context.titleSmall?.copyWith(color: context.dProvider.black5)),
              ],
            )
          ],
        );
      },
    );
  }

  void _showCardsBottomSheet(BuildContext context, PlaceOrderViewViewModel pom, IyzicoCardService iyzicoService, String? currentSelectedToken) {
    String? tempSelectedToken = currentSelectedToken;
    String? tempSelectedUserKey = pom.iyzicoCardUserKey.value;

    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (BuildContext sheetContext) {
        return StatefulBuilder(
          builder: (BuildContext context, StateSetter setState) {
            return Container(
              decoration: BoxDecoration(
                color: context.dProvider.whiteColor,
                borderRadius: const BorderRadius.only(topLeft: Radius.circular(20), topRight: Radius.circular(20)),
              ),
              padding: EdgeInsets.only(bottom: MediaQuery.of(context).viewInsets.bottom),
              child: SafeArea(
                child: Column(
                  mainAxisSize: MainAxisSize.min,
                  children: [
                    16.toHeight,
                    Text(LocalKeys.savedCardsLabel, style: context.titleLarge?.bold),
                    16.toHeight,
                    const Divider(height: 1),
                    Flexible(
                      child: ListView.builder(
                        shrinkWrap: true,
                        itemCount: iyzicoService.savedCards.length,
                        itemBuilder: (context, index) {
                          final card = iyzicoService.savedCards[index];
                          final isSelected = tempSelectedToken == card.cardToken;

                          return Container(
                            margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 6),
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(8),
                              border: Border.all(
                                color: isSelected ? context.dProvider.primaryColor : context.dProvider.black8,
                                width: isSelected ? 1.5 : 1.0,
                              ),
                            ),
                            child: ListTile(
                              onTap: () {
                                setState(() {
                                  tempSelectedToken = card.cardToken;
                                  tempSelectedUserKey = card.cardUserKey;
                                });
                              },
                              contentPadding: const EdgeInsets.symmetric(horizontal: 12, vertical: 4),
                              leading: Icon(
                                isSelected ? Icons.radio_button_checked : Icons.radio_button_unchecked,
                                color: isSelected ? context.dProvider.primaryColor : Colors.grey,
                              ),
                              title: Text(card.cardAlias ?? 'Kart', style: context.titleMedium?.bold6),
                              subtitle: Text('**** **** **** ${card.lastFourDigits ?? '****'}'),
                              trailing: Icon(Icons.credit_card, color: Colors.grey.shade400),
                            ),
                          );
                        },
                      ),
                    ),
                    // "Baska Kartla Ode" option
                    Container(
                      margin: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(8),
                        border: Border.all(color: context.dProvider.black8),
                      ),
                      child: ListTile(
                        onTap: () {
                          Navigator.pop(sheetContext);
                          pom.iyzicoUseSavedCard.value = false;
                        },
                        leading: Icon(Icons.add_circle, color: Colors.grey.shade600),
                        title: Text(LocalKeys.payWithAnotherCard, style: context.titleMedium?.bold6.copyWith(color: context.dProvider.black5)),
                      ),
                    ),
                    16.toHeight,
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 16),
                      child: CustomButton(
                        onPressed: () {
                          if (tempSelectedToken != null) {
                            pom.iyzicoSelectedCardToken.value = tempSelectedToken;
                            pom.iyzicoCardUserKey.value = tempSelectedUserKey;
                          }
                          Navigator.pop(sheetContext);
                        },
                        btText: LocalKeys.selectThisCard,
                        isLoading: false,
                      ),
                    ),
                    16.toHeight,
                  ],
                ),
              ),
            );
          },
        );
      },
    );
  }

  Widget _buildNewCardForm(BuildContext context, PlaceOrderViewViewModel pom) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        FieldWithLabel(
          label: LocalKeys.cardHolderName,
          hintText: 'Ad Soyad',
          controller: pom.iyzicoCardNameController,
          textInputAction: TextInputAction.next,
        ),
        12.toHeight,
        FieldWithLabel(
          label: LocalKeys.cardNumber,
          hintText: '0000 0000 0000 0000',
          keyboardType: TextInputType.number,
          controller: pom.iyzicoCardNumberController,
          textInputAction: TextInputAction.next,
        ),
        12.toHeight,
        Row(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Expanded(
              flex: 2,
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  FieldLabel(label: LocalKeys.expireDate),
                  Row(
                    children: [
                      Expanded(
                        child: Container(
                          padding: const EdgeInsets.symmetric(horizontal: 12),
                          decoration: BoxDecoration(
                            border: Border.all(color: context.dProvider.black8),
                            borderRadius: BorderRadius.circular(8),
                            color: context.dProvider.black9,
                          ),
                          child: DropdownButtonHideUnderline(
                            child: DropdownButton<String>(
                              isExpanded: true,
                              hint: Text(LocalKeys.month, style: TextStyle(color: context.dProvider.black5)),
                              value: pom.iyzicoExpireMonthController.text.isNotEmpty ? pom.iyzicoExpireMonthController.text : null,
                              items: List.generate(12, (index) => (index + 1).toString().padLeft(2, '0')).map((String value) {
                                return DropdownMenuItem<String>(
                                  value: value,
                                  child: Text(value),
                                );
                              }).toList(),
                              onChanged: (val) {
                                setState(() {
                                  pom.iyzicoExpireMonthController.text = val ?? '';
                                });
                              },
                            ),
                          ),
                        ),
                      ),
                      8.toWidth,
                      Expanded(
                        child: Container(
                          padding: const EdgeInsets.symmetric(horizontal: 12),
                          decoration: BoxDecoration(
                            border: Border.all(color: context.dProvider.black8),
                            borderRadius: BorderRadius.circular(8),
                            color: context.dProvider.black9,
                          ),
                          child: DropdownButtonHideUnderline(
                            child: DropdownButton<String>(
                              isExpanded: true,
                              hint: Text(LocalKeys.year, style: TextStyle(color: context.dProvider.black5)),
                              value: pom.iyzicoExpireYearController.text.isNotEmpty ? pom.iyzicoExpireYearController.text : null,
                              items: List.generate(15, (index) => (DateTime.now().year + index).toString()).map((String value) {
                                return DropdownMenuItem<String>(
                                  value: value,
                                  child: Text(value),
                                );
                              }).toList(),
                              onChanged: (val) {
                                setState(() {
                                  pom.iyzicoExpireYearController.text = val ?? '';
                                });
                              },
                            ),
                          ),
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ),
            12.toWidth,
            Expanded(
              flex: 1,
              child: FieldWithLabel(
                label: LocalKeys.cvvCvc,
                hintText: '123',
                keyboardType: TextInputType.number,
                controller: pom.iyzicoCvcController,
                textInputAction: TextInputAction.done,
              ),
            ),
          ],
        ),
        16.toHeight,
        Row(
          children: [
            SizedBox(
              height: 24,
              width: 24,
              child: Checkbox(
                value: true,
                onChanged: (val) {},
                activeColor: context.dProvider.whiteColor,
                checkColor: context.dProvider.primaryColor,
                side: BorderSide(color: context.dProvider.black8),
              ),
            ),
            8.toWidth,
            Expanded(
              child: Text(LocalKeys.payWith3DSecure, style: context.titleSmall?.copyWith(color: context.dProvider.black5)),
            ),
          ],
        ),
        8.toHeight,
        ValueListenableBuilder<bool>(
          valueListenable: pom.iyzicoSaveCard,
          builder: (context, saveCard, child) {
            return Row(
              children: [
                SizedBox(
                  height: 24,
                  width: 24,
                  child: Checkbox(
                    value: saveCard,
                    onChanged: (val) {
                      pom.iyzicoSaveCard.value = val ?? false;
                    },
                    activeColor: context.dProvider.whiteColor,
                    checkColor: context.dProvider.primaryColor,
                    side: BorderSide(color: context.dProvider.black8),
                  ),
                ),
                8.toWidth,
                Expanded(
                  child: Text(LocalKeys.saveCardForFuture, style: context.titleSmall?.copyWith(color: context.dProvider.black5)),
                ),
              ],
            );
          },
        ),
      ],
    );
  }
}

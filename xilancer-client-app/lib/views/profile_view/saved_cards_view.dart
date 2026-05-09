import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/iyzico_card_service.dart';
import 'package:xilancer/services/profile_info_service.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/utils/components/custom_preloader.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/utils/components/field_with_label.dart';
import 'package:xilancer/utils/components/field_label.dart';
import 'package:xilancer/view_models/saved_cards_view_model.dart';

class SavedCardsView extends StatefulWidget {
  static const routeName = 'saved_cards_view';
  const SavedCardsView({super.key});

  @override
  State<SavedCardsView> createState() => _SavedCardsViewState();
}

class _SavedCardsViewState extends State<SavedCardsView> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      Provider.of<IyzicoCardService>(context, listen: false).fetchSavedCards();
    });
  }

  @override
  Widget build(BuildContext context) {
    final scvm = SavedCardsViewModel.instance;

    return Scaffold(
      appBar: AppBar(
        leading: const NavigationPopIcon(),
        title: Text(LocalKeys.savedCardsLabel),
      ),
      body: Consumer<IyzicoCardService>(
        builder: (context, iyzico, child) {
          if (iyzico.isLoadingCards && iyzico.savedCards.isEmpty) {
            return const Center(child: CustomPreloader());
          }
          return Column(
            children: [
              Expanded(
                child: iyzico.savedCards.isEmpty
                    ? Center(
                        child: Column(
                          mainAxisAlignment: MainAxisAlignment.center,
                          children: [
                            Icon(Icons.credit_card_off_rounded,
                                size: 80, color: context.dProvider.black8),
                            16.toHeight,
                            Text(
                              LocalKeys.noResultFound,
                              style: context.titleMedium
                                  ?.copyWith(color: context.dProvider.black5),
                            ),
                          ],
                        ),
                      )
                    : ListView.separated(
                        padding: const EdgeInsets.all(20),
                        itemCount: iyzico.savedCards.length,
                        separatorBuilder: (context, index) => 16.toHeight,
                        itemBuilder: (context, index) {
                          final card = iyzico.savedCards[index];
                          return _buildCardItem(context, card, scvm);
                        },
                      ),
              ),
              Padding(
                padding: const EdgeInsets.all(20),
                child: CustomButton(
                  onPressed: () => _showAddCardSheet(context, scvm),
                  btText: LocalKeys.add,
                  isLoading: false,
                ),
              ),
            ],
          );
        },
      ),
    );
  }

  Widget _buildCardItem(
      BuildContext context, dynamic card, SavedCardsViewModel scvm) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: BorderRadius.circular(16),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.04),
            blurRadius: 10,
            offset: const Offset(0, 4),
          ),
        ],
        border: Border.all(color: context.dProvider.black9),
      ),
      child: Row(
        children: [
          Container(
            padding: const EdgeInsets.all(12),
            decoration: BoxDecoration(
              color: context.dProvider.primaryColor.withOpacity(0.1),
              shape: BoxShape.circle,
            ),
            child: Icon(Icons.credit_card,
                color: context.dProvider.primaryColor, size: 24),
          ),
          16.toWidth,
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  card.cardAlias ?? 'Kart',
                  style: context.titleMedium?.bold6,
                ),
                4.toHeight,
                Text(
                  "**** **** **** ${card.lastFourDigits ?? '****'}",
                  style: context.titleSmall
                      ?.copyWith(color: context.dProvider.black5),
                ),
              ],
            ),
          ),
          IconButton(
            onPressed: () {
              _showAddCardSheet(context, scvm, card: card);
            },
            icon: Icon(Icons.edit_outlined,
                color: context.dProvider.primaryColor),
          ),
          IconButton(
            onPressed: () {
              scvm.tryDeletingCard(context, card.cardToken);
            },
            icon: Icon(Icons.delete_outline_rounded,
                color: context.dProvider.warningColor),
          ),
        ],
      ),
    );
  }

  void _showAddCardSheet(BuildContext context, SavedCardsViewModel scvm, {dynamic card}) {
    scvm.resetFields();
    if (card != null) {
      final profileInfo = Provider.of<ProfileInfoService>(context, listen: false);
      final userName = "${profileInfo.profileInfoModel.data?.firstName ?? ''} ${profileInfo.profileInfoModel.data?.lastName ?? ''}".trim();
      scvm.cardNameController.text = (card.cardAlias == null || card.cardAlias == 'Kart')
          ? userName
          : card.cardAlias!;
    }
    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (context) => Container(
        decoration: BoxDecoration(
          color: context.dProvider.whiteColor,
          borderRadius: const BorderRadius.only(
              topLeft: Radius.circular(24), topRight: Radius.circular(24)),
        ),
        padding: EdgeInsets.only(
          bottom: MediaQuery.of(context).viewInsets.bottom + 24,
          top: 24,
          left: 24,
          right: 24,
        ),
        child: Column(
          mainAxisSize: MainAxisSize.min,
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Text(card == null ? LocalKeys.useNewCard : LocalKeys.edit,
                    style: context.titleLarge?.bold),
                IconButton(
                  onPressed: () => Navigator.pop(context),
                  icon: const Icon(Icons.close),
                ),
              ],
            ),
            24.toHeight,
            FieldWithLabel(
              label: LocalKeys.cardHolderName,
              hintText: 'Ad Soyad',
              controller: scvm.cardNameController,
            ),
            16.toHeight,
            FieldWithLabel(
              label: LocalKeys.cardNumber,
              hintText: '0000 0000 0000 0000',
              controller: scvm.cardNumberController,
              keyboardType: TextInputType.number,
            ),
            16.toHeight,
            Row(
              children: [
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      FieldLabel(label: LocalKeys.expireDate),
                      Row(
                        children: [
                          Expanded(
                            child: _buildDropdown(context, scvm.expireMonthController,
                                List.generate(12, (index) => (index + 1).toString().padLeft(2, '0'))),
                          ),
                          8.toWidth,
                          Expanded(
                            child: _buildDropdown(context, scvm.expireYearController,
                                List.generate(15, (index) => (DateTime.now().year + index).toString())),
                          ),
                        ],
                      ),
                    ],
                  ),
                ),
                16.toWidth,
                Expanded(
                  child: FieldWithLabel(
                    label: LocalKeys.cvvCvc,
                    hintText: '123',
                    controller: scvm.cvcController,
                    keyboardType: TextInputType.number,
                  ),
                ),
              ],
            ),
            32.toHeight,
            ValueListenableBuilder<bool>(
              valueListenable: scvm.isLoading,
              builder: (context, loading, child) => CustomButton(
                onPressed: () => scvm.trySavingCard(context),
                btText: card == null ? LocalKeys.save : LocalKeys.saveChanges,
                isLoading: loading,
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildDropdown(BuildContext context, TextEditingController controller, List<String> items) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 12),
      decoration: BoxDecoration(
        color: context.dProvider.black9,
        borderRadius: BorderRadius.circular(12),
        border: Border.all(color: context.dProvider.black8),
      ),
      child: DropdownButtonHideUnderline(
        child: StatefulBuilder(
          builder: (context, setState) => DropdownButton<String>(
            isExpanded: true,
            value: controller.text.isEmpty ? null : controller.text,
            items: items.map((e) => DropdownMenuItem(value: e, child: Text(e))).toList(),
            onChanged: (val) {
              setState(() => controller.text = val!);
            },
          ),
        ),
      ),
    );
  }
}

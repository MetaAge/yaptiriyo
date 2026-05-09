import 'package:flutter/material.dart';
import 'package:flutter_summernote/flutter_summernote.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/utils/components/field_label.dart';
import 'package:xilancer/view_models/conversation_view_model/send_offer_view_model.dart';
import 'package:xilancer/views/conversation_view/components/max_amount_suffx.dart';

import '../../../utils/components/select_date_fl.dart';
import 'send_offer_buttons.dart';

class SendOfferSheet extends StatelessWidget {
  final dynamic clientId;
  const SendOfferSheet({super.key, this.clientId});

  @override
  Widget build(BuildContext context) {
    return ChangeNotifierProvider(
      create: (context) => SendOfferViewModel(),
      child: Consumer<SendOfferViewModel>(
        builder: (context, ov, child) {
          return Container(
            decoration: BoxDecoration(
              borderRadius: const BorderRadius.only(
                  topRight: Radius.circular(20), topLeft: Radius.circular(20)),
              color: context.dProvider.whiteColor,
            ),
            constraints: BoxConstraints(maxHeight: context.height * 0.9),
            child: Column(
              children: [
                Align(
                  alignment: Alignment.center,
                  child: Container(
                    height: 4,
                    width: 48,
                    margin: const EdgeInsets.all(8),
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(12),
                      color: context.dProvider.black7,
                    ),
                  ),
                ),
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
                  child: Text(
                    LocalKeys.sendOffer,
                    style: context.titleLarge?.bold6,
                  ),
                ),
                Expanded(
                  child: SingleChildScrollView(
                    padding: const EdgeInsets.all(20),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        // Warning Box
                        Container(
                          padding: const EdgeInsets.all(12),
                          decoration: BoxDecoration(
                            color: context.dProvider.yellowColor.withOpacity(0.1),
                            borderRadius: BorderRadius.circular(8),
                            border: Border.all(color: context.dProvider.yellowColor.withOpacity(0.5)),
                          ),
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              Text(
                                "${LocalKeys.noteColon}${LocalKeys.discusBeforeSendingOffer}",
                                style: context.titleSmall?.copyWith(color: context.dProvider.yellowColor, fontSize: 12),
                              ),
                              4.toHeight,
                              Text(
                                "${LocalKeys.noteColon}${LocalKeys.milestoneSkipNote}",
                                style: context.titleSmall?.copyWith(color: context.dProvider.yellowColor, fontSize: 12),
                              ),
                            ],
                          ),
                        ),
                        20.toHeight,
                        FieldLabel(label: LocalKeys.offerPrice),
                        TextFormField(
                          controller: ov.priceController,
                          keyboardType: TextInputType.number,
                          decoration: const InputDecoration(
                              prefixIcon: CurrencyPrefix(),
                              suffixIcon: MaxAmountSuffix()),
                        ),
                        20.toHeight,
                        
                        // Payment Type Toggle
                        Row(
                          children: [
                            Expanded(
                              child: GestureDetector(
                                onTap: () => ov.setPaymentType(OfferPaymentType.single),
                                child: Container(
                                  padding: const EdgeInsets.all(12),
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(8),
                                    border: Border.all(color: ov.paymentType == OfferPaymentType.single ? context.dProvider.primaryColor : context.dProvider.black7),
                                  ),
                                  child: Column(
                                    crossAxisAlignment: CrossAxisAlignment.start,
                                    children: [
                                      Text(LocalKeys.payAtOnce, style: context.titleSmall?.bold6),
                                      4.toHeight,
                                      Text(LocalKeys.payAtOnceDesc, style: context.titleSmall?.copyWith(fontSize: 10)),
                                    ],
                                  ),
                                ),
                              ),
                            ),
                            12.toWidth,
                            Expanded(
                              child: GestureDetector(
                                onTap: () => ov.setPaymentType(OfferPaymentType.milestone),
                                child: Container(
                                  padding: const EdgeInsets.all(12),
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(8),
                                    border: Border.all(color: ov.paymentType == OfferPaymentType.milestone ? context.dProvider.primaryColor : context.dProvider.black7),
                                  ),
                                  child: Column(
                                    crossAxisAlignment: CrossAxisAlignment.start,
                                    children: [
                                      Text(LocalKeys.paByMilestones, style: context.titleSmall?.bold6),
                                      4.toHeight,
                                      Text(LocalKeys.payByMilestoneDesc, style: context.titleSmall?.copyWith(fontSize: 10)),
                                    ],
                                  ),
                                ),
                              ),
                            ),
                          ],
                        ),
                        20.toHeight,

                        if (ov.paymentType == OfferPaymentType.single) ...[
                          Row(
                            children: [
                              Expanded(
                                child: Column(
                                  crossAxisAlignment: CrossAxisAlignment.start,
                                  children: [
                                    FieldLabel(label: LocalKeys.revision),
                                    TextFormField(
                                      controller: ov.revisionController,
                                      keyboardType: TextInputType.number,
                                      decoration: InputDecoration(hintText: LocalKeys.enterRevision),
                                    ),
                                  ],
                                ),
                              ),
                              12.toWidth,
                              Expanded(
                                child: SelectDateFL(
                                  title: LocalKeys.deliveryTime,
                                  onChanged: (value) {
                                    ov.deadlineController.text = value.toString().split(" ")[0];
                                  },
                                ),
                              ),
                            ],
                          ),
                          20.toHeight,
                          FieldLabel(label: LocalKeys.description),
                          FlutterSummernote(
                            key: ov.keyEditor,
                            hint: LocalKeys.writeMilestoneDesc,
                          ),
                        ] else ...[
                          // Milestones Section
                          FieldLabel(label: LocalKeys.milestones),
                          ...ov.milestones.asMap().entries.map((entry) => Card(
                            margin: const EdgeInsets.only(bottom: 10),
                            child: ListTile(
                              title: Text(entry.value.name, style: context.titleSmall?.bold6),
                              subtitle: Text("${entry.value.price.toString().cur} - ${entry.value.dTime}"),
                              trailing: IconButton(icon: const Icon(Icons.delete, color: Colors.red), onPressed: () => ov.removeMilestone(entry.key)),
                            ),
                          )),
                          
                          Container(
                            padding: const EdgeInsets.all(12),
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(8),
                              border: Border.all(color: context.dProvider.black8),
                            ),
                            child: Column(
                              children: [
                                TextFormField(
                                  controller: ov.milestoneTitleController,
                                  decoration: InputDecoration(hintText: LocalKeys.milestoneName),
                                ),
                                8.toHeight,
                                Row(
                                  children: [
                                    Expanded(
                                      child: TextFormField(
                                        controller: ov.milestonePriceController,
                                        keyboardType: TextInputType.number,
                                        decoration: InputDecoration(hintText: LocalKeys.milestoneAmount, prefixIcon: const CurrencyPrefix()),
                                      ),
                                    ),
                                    8.toWidth,
                                    Expanded(
                                      child: TextFormField(
                                        controller: ov.milestoneRevisionController,
                                        keyboardType: TextInputType.number,
                                        decoration: InputDecoration(hintText: LocalKeys.revision),
                                      ),
                                    ),
                                  ],
                                ),
                                8.toHeight,
                                SelectDateFL(
                                  title: LocalKeys.deliveryDate,
                                  onChanged: (value) {
                                    ov.milestoneDeadlineController.text = value.toString().split(" ")[0];
                                  },
                                ),
                                8.toHeight,
                                TextFormField(
                                  controller: ov.milestoneDescriptionController,
                                  decoration: InputDecoration(hintText: LocalKeys.description),
                                ),
                                12.toHeight,
                                OutlinedButton.icon(
                                  onPressed: ov.addMilestone,
                                  icon: const Icon(Icons.add),
                                  label: Text(LocalKeys.addMilestone),
                                )
                              ],
                            ),
                          ),
                        ],
                        30.toHeight,
                        SendOfferButtons(clientId: clientId),
                        20.toHeight,
                      ],
                    ),
                  ),
                ),
              ],
            ),
          );
        }
      ),
    );
  }
}

class CurrencyPrefix extends StatelessWidget {
  const CurrencyPrefix({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return Column(
      mainAxisAlignment: MainAxisAlignment.center,
      children: [
        Container(
          padding: const EdgeInsets.symmetric(horizontal: 12),
          decoration: BoxDecoration(
            border: Border(
                left: context.dProvider.textDirectionRight
                    ? BorderSide(
                        color: context.dProvider.black7,
                      )
                    : BorderSide.none,
                right: context.dProvider.textDirectionRight
                    ? BorderSide.none
                    : BorderSide(
                        color: context.dProvider.black7,
                      )),
          ),
          child: Text(
            context.dProvider.currencySymbol,
            style: context.titleLarge
                ?.copyWith(color: context.dProvider.primaryColor)
                .bold6,
          ),
        ),
      ],
    );
  }
}

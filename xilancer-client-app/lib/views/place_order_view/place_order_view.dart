import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/payment_gateway_service.dart';
import 'package:xilancer/services/wallet_history_service.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/utils/components/field_label.dart';
import 'package:xilancer/utils/components/field_with_label.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/utils/components/warning_widget.dart';
import 'package:xilancer/view_models/place_order_view_model/place_order_view_model.dart';
import 'package:xilancer/views/payment_views/payment_gateways.dart';
import 'package:xilancer/views/place_order_view/components/milestones.dart';
import 'package:xilancer/views/place_order_view/components/address_selection_widget.dart';
import 'package:xilancer/views/place_order_view/components/appointment_selection_widget.dart';

class PlaceOrderView extends StatelessWidget {
  final projectId;
  final offerId;
  final jobId;
  final proposalId;
  final num amount;
  const PlaceOrderView({
    super.key,
    this.projectId,
    this.offerId,
    this.jobId,
    this.proposalId,
    this.amount = 0,
  });

  @override
  Widget build(BuildContext context) {
    final pom = PlaceOrderViewViewModel.instance;
    return Scaffold(
      appBar: AppBar(
        leading: const NavigationPopIcon(),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Container(
          padding: const EdgeInsets.all(20),
          decoration: BoxDecoration(
            color: context.dProvider.whiteColor,
            borderRadius: BorderRadius.circular(20),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              WarningWidget(text: LocalKeys.orderWarning),
              16.toHeight,
              const AddressSelectionWidget(),
              const AppointmentSelectionWidget(),
              16.toHeight,
              ValueListenableBuilder(
                valueListenable: pom.walletSelect,
                builder: (context, ws, child) {
                  return Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      CheckboxListTile(
                        contentPadding: EdgeInsets.zero,
                        visualDensity: VisualDensity.compact,
                        value: ws,
                        onChanged: (value) {
                          pom.walletSelect.value = !ws;
                        },
                        title: Text(
                          LocalKeys.useWalletBallance,
                          style: context.titleMedium?.copyWith(color: context.dProvider.black5),
                        ),
                        controlAffinity: ListTileControlAffinity.leading,
                        side: BorderSide(color: context.dProvider.black8),
                        checkColor: context.dProvider.whiteColor,
                        activeColor: context.dProvider.primaryColor,
                      ),
                      if (ws)
                        Consumer<WalletHistoryService>(
                          builder: (context, whProvider, child) {
                            if (whProvider.shouldAutoFetch) {
                              Future.microtask(() {
                                whProvider.fetchWalletHistory();
                              });
                            }
                            final walletBalance = whProvider.walletHistory.walletBalance ?? 0;
                            return Container(
                              margin: const EdgeInsets.only(top: 8, bottom: 8),
                              padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 12),
                              decoration: BoxDecoration(
                                color: context.dProvider.black8.withOpacity(0.3),
                                borderRadius: BorderRadius.circular(8),
                              ),
                              child: Column(
                                children: [
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                    children: [
                                      Text(LocalKeys.availableBalance, style: context.titleSmall?.copyWith(color: context.dProvider.black5)),
                                      Text(walletBalance.toStringAsFixed(2).cur, style: context.titleSmall?.copyWith(color: context.dProvider.black5)),
                                    ],
                                  ),
                                  4.toHeight,
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                    children: [
                                      Text(LocalKeys.amount, style: context.titleSmall?.copyWith(color: context.dProvider.black5)),
                                      Text("-${amount.toStringAsFixed(2).cur}", style: context.titleSmall?.copyWith(color: context.dProvider.warningColor)),
                                    ],
                                  ),
                                  Divider(height: 16, color: context.dProvider.black8),
                                  Row(
                                    mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                    children: [
                                      Text(LocalKeys.balance, style: context.titleSmall?.copyWith(color: context.dProvider.black5, fontWeight: FontWeight.bold)),
                                      Text(
                                        (walletBalance - amount) >= 0 
                                          ? (walletBalance - amount).toStringAsFixed(2).cur 
                                          : "-" + (amount - walletBalance).toStringAsFixed(2).cur, 
                                        style: context.titleSmall?.copyWith(
                                          color: (walletBalance - amount) >= 0 ? context.dProvider.black5 : context.dProvider.warningColor, 
                                          fontWeight: FontWeight.bold
                                        )
                                      ),
                                    ],
                                  ),
                                  if ((walletBalance - amount) < 0) ...[
                                    8.toHeight,
                                    Text(LocalKeys.insufficientBalance, style: context.titleSmall?.copyWith(color: context.dProvider.warningColor)),
                                  ]
                                ],
                              ),
                            );
                          },
                        ),
                      if (!ws) ...[
                            // Moved transaction fee to bottom
                        // Unified credit card entry doesn't need "Select a payment method" label
                        PaymentGateways(
                          gatewayNotifier: pom.selectedGateway,
                          attachmentNotifier: pom.selectedAttachment,
                          cardController: pom.aCardController,
                          secretCodeController: pom.authCodeController,
                          zUsernameController: pom.zUsernameController,
                          expireDateNotifier: pom.authNetExpireDate,
                          usernameController: TextEditingController(),
                        ),
                        16.toHeight,
                      ],
                    ],
                  );
                },
              ),
              FieldWithLabel(
                label: LocalKeys.description,
                hintText: LocalKeys.enterDescription,
                textInputAction: TextInputAction.newline,
                controller: pom.descriptionController,
                minLines: 3,
                maxLines: 10,
              ),
              if (projectId != null)
                Consumer<PaymentGatewayService>(builder: (context, pg, child) {
                  if (!pg.projectOrderMilestoneAllowed) {
                    return SizedBox();
                  }
                  return ValueListenableBuilder(
                    valueListenable: pom.addMilestones,
                    builder: (context, ms, child) {
                      return Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          CheckboxListTile(
                            contentPadding: EdgeInsets.zero,
                            visualDensity: VisualDensity.compact,
                            value: ms,
                            onChanged: (value) {
                              pom.addMilestones.value = !ms;
                            },
                            title: Text(
                              LocalKeys.paByMilestones,
                              style: context.titleMedium?.copyWith(color: context.dProvider.black5),
                            ),
                            controlAffinity: ListTileControlAffinity.leading,
                            side: BorderSide(color: context.dProvider.black8),
                            checkColor: context.dProvider.whiteColor,
                            activeColor: context.dProvider.primaryColor,
                          ),
                          Text(
                            LocalKeys.paByMilestonesDesc,
                            style: context.titleSmall
                                ?.copyWith(color: context.dProvider.black5),
                          ),
                          6.toHeight,
                          if (ms) const Milestones(),
                        ],
                      );
                    },
                  );
                }),
              ValueListenableBuilder(
                valueListenable: pom.walletSelect,
                builder: (context, ws, child) {
                  return ValueListenableBuilder(
                    valueListenable: pom.selectedGateway,
                    builder: (context, sg, child) {
                      return Consumer<PaymentGatewayService>(
                        builder: (context, pg, child) {
                          if (ws || pg.transactionFee <= 0 || sg?.name == "manual_payment") {
                            return SizedBox();
                          }
                          return Column(
                            children: [
                              Row(
                                mainAxisAlignment: MainAxisAlignment.spaceBetween,
                                children: [
                                  Text(
                                    LocalKeys.transactionFee,
                                    style: context.titleMedium?.copyWith(
                                      color: context.dProvider.black5,
                                      fontWeight: FontWeight.bold,
                                    ),
                                  ),
                                  Text(
                                    pg.getTransactionAmount(amount).toStringAsFixed(2).cur,
                                    style: context.titleMedium?.copyWith(
                                      color: context.dProvider.black5,
                                      fontWeight: FontWeight.bold,
                                    ),
                                  )
                                ],
                              ),
                              16.toHeight,
                            ],
                          );
                        },
                      );
                    },
                  );
                },
              ),
              ValueListenableBuilder(
                valueListenable: pom.isLoading,
                builder: (context, loading, child) {
                  return CustomButton(
                      onPressed: () {
                        pom.tryPlacingOrder(
                          context: context,
                          projectId: projectId,
                          jobId: jobId,
                          proposalId: proposalId,
                          offerId: offerId,
                        );
                      },
                      btText: LocalKeys.placeOrder,
                      isLoading: loading);
                },
              ),
            ],
          ),
        ),
      ),
    );
  }
}

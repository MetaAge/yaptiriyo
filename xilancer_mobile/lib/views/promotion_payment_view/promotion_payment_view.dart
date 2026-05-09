import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/utils/components/warning_widget.dart';
import 'package:xilancer/view_models/promotion_payment_view_model/promotion_payment_view_model.dart';

import '../../helper/local_keys.g.dart';
import '../../utils/components/custom_button.dart';
import '../../utils/components/field_label.dart';
import '../../utils/components/navigation_pop_icon.dart';
import '../../utils/components/promotion_packages_dropdown.dart';
import '../payment_views/payment_gateways.dart';

class PromotionPaymentView extends StatelessWidget {
  const PromotionPaymentView({super.key});

  @override
  Widget build(BuildContext context) {
    final ppm = PromotionPaymentViewModel.instance;
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
            borderRadius: BorderRadius.circular(8),
          ),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              WarningWidget(text: LocalKeys.promotionDayWarningNote),
              PromotionPackagesDropdown(
                packageNotifier: ppm.selectedPackage,
              ),
              ValueListenableBuilder(
                valueListenable: ppm.walletSelect,
                builder: (context, ws, child) {
                  return Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      CheckboxListTile(
                        contentPadding: EdgeInsets.zero,
                        visualDensity: VisualDensity.compact,
                        value: ws,
                        onChanged: (value) {
                          ppm.walletSelect.value = !ws;
                        },
                        title: Text(LocalKeys.useWalletBallance),
                        controlAffinity: ListTileControlAffinity.leading,
                      ),
                      if (!ws) ...[
                        FieldLabel(label: LocalKeys.selectAPaymentMethod),
                        PaymentGateways(
                          gatewayNotifier: ppm.selectedGateway,
                          attachmentNotifier: ppm.selectedAttachment,
                          cardController: ppm.aCardController,
                          secretCodeController: ppm.authCodeController,
                          zUsernameController: ppm.zUsernameController,
                          expireDateNotifier: ppm.authNetExpireDate,
                          usernameController: TextEditingController(),
                        ),
                      ],
                      16.toHeight,
                      ValueListenableBuilder(
                        valueListenable: ppm.isLoading,
                        builder: (context, loading, child) {
                          return CustomButton(
                            onPressed: () {
                              ppm.tryPromotionBuy(context);
                            },
                            btText: LocalKeys.promoteNow,
                            isLoading: loading,
                          );
                        },
                      )
                    ],
                  );
                },
              ),
            ],
          ),
        ),
      ),
    );
  }
}

import 'dart:io';

import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:flutter_widget_from_html/flutter_widget_from_html.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/payment_gateway_service.dart';
import 'package:xilancer/utils/components/custom_preloader.dart';
import 'package:xilancer/utils/components/field_with_label.dart';

import '/helper/extension/context_extension.dart';
import '/helper/extension/string_extension.dart';
import '/helper/svg_assets.dart';
import '../../models/payment_gateway_model.dart';
import '../../utils/components/attachment_select.dart';
import 'components/auth_net_card_infos.dart';
import 'components/iyzico_card_form.dart';

class PaymentGateways extends StatelessWidget {
  final ValueNotifier<Gateway?> gatewayNotifier;
  final ValueNotifier<File?> attachmentNotifier;
  final TextEditingController cardController;
  final TextEditingController usernameController;
  final TextEditingController secretCodeController;
  final TextEditingController zUsernameController;
  final ValueNotifier<DateTime?> expireDateNotifier;
  const PaymentGateways({
    super.key,
    required this.gatewayNotifier,
    required this.attachmentNotifier,
    required this.cardController,
    required this.usernameController,
    required this.secretCodeController,
    required this.zUsernameController,
    required this.expireDateNotifier,
  });

  @override
  Widget build(BuildContext context) {
    return Consumer<PaymentGatewayService>(builder: (context, pg, child) {
      return FutureBuilder(
          future: pg.shouldAutoFetch ? pg.fetchGateways() : null,
          builder: (context, snap) {
            if (snap.connectionState == ConnectionState.waiting) {
              return const CustomPreloader();
            }
            return Container(
              // padding: const EdgeInsets.symmetric(horizontal: 28, vertical: 12),
              decoration: BoxDecoration(
                color: context.dProvider.whiteColor,
              ),
              child: ValueListenableBuilder(
                valueListenable: gatewayNotifier,
                builder: (context, value, child) => Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      const Row(),
                      Builder(
                        builder: (context) {
                          // Auto-select iyzipay automatically if available and none selected yet
                          if (gatewayNotifier.value == null && pg.gatewayList.isNotEmpty) {
                            WidgetsBinding.instance.addPostFrameCallback((_) {
                              try {
                                gatewayNotifier.value = pg.gatewayList.firstWhere((e) => e.name == "iyzipay");
                              } catch (e) {
                                // Fallback
                                gatewayNotifier.value = pg.gatewayList.first;
                              }
                            });
                          }
                          // Intentionally omitting the Wrap containing gateway logos to provide a native unified credit card entry experience
                          return const SizedBox.shrink();
                        }
                      ),
                      if (gatewayNotifier.value?.name == "manual_payment") ...[
                        if ((gatewayNotifier
                                    .value?.siteManualPaymentDescription ??
                                "")
                            .isNotEmpty) ...[
                          12.toHeight,
                          Container(
                            padding: const EdgeInsets.all(12),
                            decoration: BoxDecoration(
                              borderRadius: BorderRadius.circular(16),
                              color: context.dProvider.black9,
                            ),
                            child: HtmlWidget(
                              gatewayNotifier
                                  .value!.siteManualPaymentDescription!,
                            ),
                          ),
                        ],
                        12.toHeight,
                        AttachmentSelect(
                            attachmentNotifier: attachmentNotifier),
                      ],
                      if (gatewayNotifier.value?.name ==
                          "authorize_dot_net") ...[
                        12.toHeight,
                        AuthCardInfos(
                            cardController: cardController,
                            usernameController: usernameController,
                            secretCodeController: secretCodeController,
                            expireDateNotifier: expireDateNotifier),
                      ],
                      if (gatewayNotifier.value?.name == "zitopay") ...[
                        12.toHeight,
                        FieldWithLabel(
                          label: LocalKeys.username,
                          hintText: LocalKeys.enterUsername,
                          controller: zUsernameController,
                        ),
                      ],
                      if (gatewayNotifier.value?.name == "iyzipay") ...[
                        12.toHeight,
                        const IyzicoCardForm(),
                      ],
                    ]),
              ),
            );
          });
    });
  }
}

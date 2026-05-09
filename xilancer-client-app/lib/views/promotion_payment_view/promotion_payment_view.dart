import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/view_models/promotion_payment_view_model/promotion_payment_view_model.dart';
import 'package:xilancer/views/promotion_payment_view/components/promotion_benefit_card.dart';

import '../../helper/local_keys.g.dart';
import '../../utils/components/custom_button.dart';
import '../../utils/components/field_label.dart';
import '../../utils/components/navigation_pop_icon.dart';
import '../../utils/components/promotion_packages_dropdown.dart';
import '../payment_views/payment_gateways.dart';

class PromotionPaymentView extends StatelessWidget {
  static const routeName = 'promotion_payment_view';
  const PromotionPaymentView({super.key});

  @override
  Widget build(BuildContext context) {
    final ppm = PromotionPaymentViewModel.instance;
    return Scaffold(
      backgroundColor: context.dProvider.whiteColor,
      appBar: AppBar(
        leading: const NavigationPopIcon(),
        title: Text(
          LocalKeys.promoteNow,
          style: context.titleLarge?.copyWith(fontWeight: FontWeight.bold),
        ),
        elevation: 0,
        backgroundColor: Colors.transparent,
      ),
      body: SingleChildScrollView(
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            // Hero Section
            Container(
              width: double.infinity,
              padding: const EdgeInsets.all(24),
              decoration: BoxDecoration(
                gradient: LinearGradient(
                  colors: [
                    context.dProvider.primaryColor,
                    context.dProvider.primaryColor.withOpacity(0.8),
                  ],
                  begin: Alignment.topLeft,
                  end: Alignment.bottomRight,
                ),
                borderRadius: const BorderRadius.only(
                  bottomLeft: Radius.circular(32),
                  bottomRight: Radius.circular(32),
                ),
              ),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  Container(
                    padding:
                        const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                    decoration: BoxDecoration(
                      color: Colors.white.withOpacity(0.2),
                      borderRadius: BorderRadius.circular(20),
                    ),
                    child: Text(
                      LocalKeys.pro.toUpperCase(),
                      style: context.labelSmall?.copyWith(
                        color: Colors.white,
                        fontWeight: FontWeight.bold,
                      ),
                    ),
                  ),
                  const SizedBox(height: 16),
                  Text(
                    LocalKeys.promotionBenefits,
                    style: context.headlineMedium?.copyWith(
                      color: Colors.white,
                      fontWeight: FontWeight.w900,
                      fontSize: 24,
                    ),
                  ),
                  const SizedBox(height: 8),
                  Text(
                    LocalKeys.promotionDayWarningNote,
                    style: context.bodyMedium?.copyWith(
                      color: Colors.white.withOpacity(0.9),
                    ),
                  ),
                ],
              ),
            ),

            Padding(
              padding: const EdgeInsets.all(24),
              child: Column(
                crossAxisAlignment: CrossAxisAlignment.start,
                children: [
                  // Benefits List
                  PromotionBenefitCard(
                    icon: Icons.visibility_rounded,
                    title: LocalKeys.increaseVisibility,
                    description: LocalKeys.increaseVisibilityDesc,
                  ),
                  PromotionBenefitCard(
                    icon: Icons.rocket_launch_rounded,
                    title: LocalKeys.getHiredFaster,
                    description: LocalKeys.getHiredFasterDesc,
                    iconColor: Colors.orange,
                  ),
                  PromotionBenefitCard(
                    icon: Icons.verified_rounded,
                    title: LocalKeys.featuredBadge,
                    description: LocalKeys.featuredBadgeDesc,
                    iconColor: Colors.blue,
                  ),

                  const SizedBox(height: 16),
                  const Divider(),
                  const SizedBox(height: 24),

                  // Selection Section
                  PromotionPackagesDropdown(
                    packageNotifier: ppm.selectedPackage,
                  ),

                  const SizedBox(height: 24),

                  ValueListenableBuilder(
                    valueListenable: ppm.walletSelect,
                    builder: (context, ws, child) {
                      return Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          Container(
                            decoration: BoxDecoration(
                              color: ws
                                  ? context.dProvider.primaryColor
                                      .withOpacity(0.05)
                                  : context.dProvider.whiteColor,
                              borderRadius: BorderRadius.circular(12),
                              border: Border.all(
                                color: ws
                                    ? context.dProvider.primaryColor
                                    : context.dProvider.black9,
                              ),
                            ),
                            child: CheckboxListTile(
                              contentPadding:
                                  const EdgeInsets.symmetric(horizontal: 16),
                              visualDensity: VisualDensity.compact,
                              value: ws,
                              onChanged: (value) {
                                ppm.walletSelect.value = value ?? false;
                              },
                              title: Text(
                                LocalKeys.useWalletBallance,
                                style: context.titleSmall?.copyWith(
                                  fontWeight:
                                      ws ? FontWeight.bold : FontWeight.normal,
                                ),
                              ),
                              activeColor: context.dProvider.primaryColor,
                              controlAffinity: ListTileControlAffinity.leading,
                            ),
                          ),

                          if (!ws) ...[
                            const SizedBox(height: 24),
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

                          const SizedBox(height: 32),

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
                          ),
                          const SizedBox(height: 24),
                        ],
                      );
                    },
                  ),
                ],
              ),
            ),
          ],
        ),
      ),
    );
  }
}

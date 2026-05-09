import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/wallet_history_service.dart';
import 'package:xilancer/utils/components/custom_future_widget.dart';
import 'package:xilancer/utils/components/custom_preloader.dart';
import 'package:xilancer/utils/components/custom_refresh_indicator.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/services/user_mode_service.dart';
import 'package:xilancer/view_models/wallet_view_model/wallet_view_model.dart';

import 'components/remaining_balance.dart';
import 'components/wallet_history.dart';
import 'components/wallet_history_tile.dart';
import 'components/wallet_view_skeleton.dart';
import '../withdraw_money_view/withdraw_money_view.dart';
import '../wallet_deposit_view/wallet_deposit_view.dart';

class WalletView extends StatelessWidget {
  static const routeName = 'wallet_view';
  const WalletView({super.key});
  @override
  Widget build(BuildContext context) {
    final wvm = WalletViewModel.instance;
    wvm.scrollController.addListener(() {
      wvm.tryToLoadMore(context);
    });
    final whProvider =
        Provider.of<WalletHistoryService>(context, listen: false);
    return Scaffold(
        appBar: AppBar(
          leading: const NavigationPopIcon(),
          title: Text(LocalKeys.wallet),
        ),
        body: CustomRefreshIndicator(
          onRefresh: () async {
            await whProvider.fetchWalletHistory();
          },
          child: CustomFutureWidget(
            function: whProvider.shouldAutoFetch
                ? whProvider.fetchWalletHistory()
                : null,
            shimmer: const WalletViewSkeleton(),
            child:
                Consumer<WalletHistoryService>(builder: (context, wh, child) {
              return Scrollbar(
                controller: wvm.scrollController,
                child: ListView.separated(
                    controller: wvm.scrollController,
                    padding: const EdgeInsets.all(20),
                    physics: const AlwaysScrollableScrollPhysics(),
                    itemBuilder: (context, index) {
                      debugPrint((wh.walletHistory.histories?.data).toString());
                      switch (index) {
                        case 0:
                          return Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              RemainingBalance(
                                amount: wh.walletHistory.walletBalance ?? 0,
                              ),
                              24.toHeight,
                              // Quick Action Buttons
                              Row(
                                children: [
                                  if (!UserModeService.instance.isFreelancer)
                                    Expanded(
                                      child: _buildActionButton(
                                        context,
                                        title: LocalKeys.deposit,
                                        icon: Icons.add_circle_outline_rounded,
                                        color: context.dProvider.primaryColor,
                                        onTap: () {
                                          context.toNamed(
                                              WalletDepositView.routeName,
                                              then: () {
                                            whProvider.fetchWalletHistory();
                                          });
                                        },
                                      ),
                                    ),
                                  if (UserModeService.instance.isFreelancer)
                                    Expanded(
                                      child: _buildActionButton(
                                        context,
                                        title: LocalKeys.withdraw,
                                        icon: Icons.outbound_outlined,
                                        color: const Color(
                                            0xFF6366F1), // Indigo
                                        onTap: () {
                                          context.toNamed(
                                              WithdrawMoneyView.routeName,
                                              then: () {
                                            whProvider.fetchWalletHistory();
                                          });
                                        },
                                      ),
                                    ),
                                ],
                              ),
                              32.toHeight,
                              Text(
                                LocalKeys.walletHistory,
                                style: context.titleMedium?.bold6.copyWith(
                                  color: context.dProvider.black2,
                                  fontSize: 18,
                                ),
                              ),
                              16.toHeight,
                              if (wh.walletHistory.histories?.data?.isEmpty ??
                                  true)
                                Container(
                                  width: double.infinity,
                                  padding:
                                      const EdgeInsets.symmetric(vertical: 40),
                                  child: Column(
                                    mainAxisAlignment: MainAxisAlignment.center,
                                    children: [
                                      LottieBuilder.asset(
                                        "assets/animations/empty_list.json",
                                        width: context.width / 1.7,
                                        height: context.width / 1.7,
                                        fit: BoxFit.cover,
                                        repeat: false,
                                      ),
                                      Text(
                                        LocalKeys.noHistoryFound,
                                        style: context.titleSmall
                                            ?.copyWith(
                                                color: context
                                                    .dProvider.black5)
                                            .bold6,
                                      ),
                                    ],
                                  ),
                                )
                            ],
                          );
                        default:
                          if (wh.nextPage != null &&
                              (wh.walletHistory.histories!.data!.length + 1) ==
                                  index) {
                            return const CustomPreloader();
                          }
                          final hItem =
                              wh.walletHistory.histories!.data![index - 1];
                          return WalletHistoryTile(
                              amount: (hItem.amount ?? 0).toStringAsFixed(2),
                              pMethod: hItem.paymentGateway ?? "",
                              pStatus: hItem.paymentStatus.isEmpty
                                  ? LocalKeys.cancel
                                  : hItem.paymentStatus,
                              type: hItem.type,
                              cDate: hItem.createdAt ?? DateTime.now());
                      }
                    },
                    separatorBuilder: (context, index) => 0.toHeight,
                    itemCount: (wh.walletHistory.histories?.data ?? []).length +
                        (wh.nextPage != null && !wh.nexLoadingFailed ? 2 : 1)),
              );
            }),
          ),
        ));
  }

  Widget _buildActionButton(BuildContext context,
      {required String title,
      required IconData icon,
      required Color color,
      required VoidCallback onTap}) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 20),
        decoration: BoxDecoration(
          color: context.dProvider.whiteColor,
          borderRadius: BorderRadius.circular(24),
          border: Border.all(color: context.dProvider.black8.withOpacity(0.5)),
          boxShadow: [
            BoxShadow(
              color: color.withOpacity(0.1),
              blurRadius: 10,
              offset: const Offset(0, 4),
            ),
          ],
        ),
        child: Column(
          children: [
            Container(
              padding: const EdgeInsets.all(12),
              decoration: BoxDecoration(
                color: color.withOpacity(0.1),
                shape: BoxShape.circle,
              ),
              child: Icon(icon, color: color, size: 28),
            ),
            const SizedBox(height: 12),
            Text(
              title,
              style: context.titleSmall?.copyWith(
                fontWeight: FontWeight.bold,
                color: context.dProvider.black3,
                fontSize: 13,
              ),
            ),
          ],
        ),
      ),
    );
  }
}

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/profile_info_service.dart';
import 'package:xilancer/services/project_details_service.dart'; // Added
import 'package:xilancer/services/user_mode_service.dart';
import 'package:xilancer/view_models/place_order_view_model/place_order_view_model.dart';
import 'package:xilancer/view_models/project_details_view_model/project_details_view_model.dart';
import 'package:xilancer/view_models/sign_in_view/sign_in_view_model.dart';
import 'package:xilancer/view_models/sign_up_view/sign_up_view_model.dart';
import 'package:xilancer/views/place_order_view/place_order_view.dart';
import 'package:xilancer/views/sign_in_view/sign_in_view.dart';

class ProjectDetailsPackageChanges extends StatelessWidget {
  final String regularCharge;
  final num discountCharge;
  final projectId;
  const ProjectDetailsPackageChanges({
    super.key,
    required this.regularCharge,
    required this.discountCharge,
    required this.projectId,
  });

  @override
  Widget build(BuildContext context) {
    final pdm = ProjectDetailsViewModel.instance;
    return Consumer2<ProfileInfoService, ProjectDetailsService>(
        builder: (context, pi, pd, child) {
      final packages = pd.projectPackages[projectId.toString()] ?? [];
      return ValueListenableBuilder(
        valueListenable: pdm.packageIndex,
        builder: (context, index, child) {
          if (packages.isEmpty || index >= packages.length) {
            return const SizedBox();
          }
          final package = packages[index];
          final currentPrice = (package.discountPrice ?? 0) > 0
              ? package.discountPrice!
              : package.regularPrice;
          final regularPrice = package.regularPrice;

          return Padding(
            padding: const EdgeInsets.symmetric(horizontal: 0),
            child: Row(
              children: [
                Expanded(
                  child: Column(
                    mainAxisSize: MainAxisSize.min,
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        LocalKeys.charges,
                        style: context.bodySmall?.copyWith(
                          color: context.dProvider.black5,
                          fontWeight: FontWeight.w500,
                        ),
                      ),
                      FittedBox(
                        child: Row(
                          crossAxisAlignment: CrossAxisAlignment.baseline,
                          textBaseline: TextBaseline.alphabetic,
                          children: [
                            Text(
                              currentPrice.toStringAsFixed(2).cur.toString(),
                              style: context.titleLarge!.bold6.copyWith(
                                color: context.dProvider.primaryColor,
                                fontSize: 24,
                              ),
                            ),
                            if ((package.discountPrice ?? 0) > 0) ...[
                              8.toWidth,
                              Text(
                                regularPrice.toStringAsFixed(2).cur.toString(),
                                style: context.bodySmall?.copyWith(
                                  color: context.dProvider.black5,
                                  decoration: TextDecoration.lineThrough,
                                ),
                              ),
                            ],
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
                const SizedBox(width: 16),
                Expanded(
                  child: Container(
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(12),
                      gradient: LinearGradient(
                        colors: [
                          context.dProvider.primaryColor,
                          context.dProvider.primaryColor.withOpacity(0.85),
                        ],
                      ),
                      boxShadow: [
                        BoxShadow(
                          color: context.dProvider.primaryColor.withOpacity(0.3),
                          blurRadius: 12,
                          offset: const Offset(0, 4),
                        ),
                      ],
                    ),
                    child: ElevatedButton(
                      style: ElevatedButton.styleFrom(
                        backgroundColor: Colors.transparent,
                        foregroundColor: context.dProvider.whiteColor,
                        shadowColor: Colors.transparent,
                        elevation: 0,
                        padding: const EdgeInsets.symmetric(vertical: 14),
                        shape: RoundedRectangleBorder(
                          borderRadius: BorderRadius.circular(12),
                        ),
                      ),
                      onPressed: () {
                        if (pi.profileInfoModel.data == null) {
                          SignInViewModel.dispose;
                          SignInViewModel.instance.initSavedInfo();
                          SignUpViewModel.dispose;
                          context.toNamed(SignInView.routeName);
                          return;
                        }
                        if (UserModeService.of(context, listen: false).isFreelancer) {
                          LocalKeys.freelancersCannotPlaceOrders.showToast();
                          return;
                        }
                        final projectDetails = pd.projectDetailsModel[projectId.toString()]?.projectDetails;
                        if (pi.profileInfoModel.data?.id.toString() ==
                            projectDetails?.projectCreator?.id.toString()) {
                          "Kendi ilanınıza sipariş veremezsiniz".showToast();
                          return;
                        }
                        PlaceOrderViewViewModel.dispose;
                        context.toPage(PlaceOrderView(
                          projectId: projectId,
                          amount: currentPrice,
                        ));
                      },
                      child: Text(
                        pi.profileInfoModel.data != null
                            ? (UserModeService.of(context, listen: false).isClient
                                ? LocalKeys.orderNow
                                : LocalKeys.viewDetails)
                            : LocalKeys.signIn,
                        style: context.titleSmall?.bold6.copyWith(
                          color: context.dProvider.whiteColor,
                        ),
                      ),
                    ),
                  ),
                ),
              ],
            ),
          );
        },
      );
    });
  }
}

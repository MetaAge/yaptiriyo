import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/views/sign_in_view/sign_in_view.dart';

import '../../view_models/sign_in_view/sign_in_view_model.dart';
import '../../view_models/sign_up_view/sign_up_view_model.dart';

class AccountSkeleton extends StatelessWidget {
  const AccountSkeleton({super.key});

  @override
  Widget build(BuildContext context) {
    return Container(
      alignment: Alignment.center,
      color: context.dProvider.whiteColor,
      child: Padding(
        padding: const EdgeInsets.symmetric(horizontal: 40),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            LottieBuilder.asset(
              "assets/animations/sign_in.json",
              height: 240,
              repeat: true,
            ),
            const SizedBox(height: 20),
            Text(
              "Giriş Yapmalısın",
              style: context.titleLarge?.bold6.copyWith(fontSize: 24),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 12),
            Text(
              "Profilini görüntülemek ve hizmetlerden yararlanmak için lütfen giriş yap.",
              style: context.bodyMedium?.copyWith(color: context.dProvider.black5),
              textAlign: TextAlign.center,
            ),
            const SizedBox(height: 40),
            CustomButton(
              onPressed: () {
                SignInViewModel.dispose;
                SignInViewModel.instance.initSavedInfo();
                SignUpViewModel.dispose;
                context.toNamed(SignInView.routeName);
              },
              btText: LocalKeys.signIn,
              isLoading: false,
            ),
          ],
        ),
      ),
    );
  }
}

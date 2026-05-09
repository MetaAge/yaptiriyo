import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import '../../services/internet_checker_service.dart';
import 'empty_spacer_helper.dart';

class InternetCheckerWidget extends StatelessWidget {
  final Widget widget;
  final Widget loadingWidget;
  final retryFunction;

  const InternetCheckerWidget(
      {required this.widget,
      required this.loadingWidget,
      this.retryFunction,
      super.key});

  @override
  Widget build(BuildContext context) {
    final ic = Provider.of<InternetCheckerService>(context, listen: false);
    return FutureBuilder(
      future: ic.checkConnection(),
      builder: (context, snapshot) {
        if (snapshot.connectionState == ConnectionState.waiting) {
          return loadingWidget;
        }
        return ic.haveConnection
            ? widget
            : Scaffold(
                backgroundColor: context.dProvider.black9,
                body: Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 40),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      LottieBuilder.asset(
                        'assets/animations/no_internet.json',
                        height: 280,
                      ),
                      const SizedBox(height: 32),
                      Text(
                        LocalKeys.oops,
                        style: context.titleLarge?.bold6.copyWith(fontSize: 28),
                        textAlign: TextAlign.center,
                      ),
                      const SizedBox(height: 12),
                      Text(
                        LocalKeys.noConnectionFound,
                        style: context.bodyMedium?.copyWith(color: context.dProvider.black5),
                        textAlign: TextAlign.center,
                      ),
                      const SizedBox(height: 40),
                      if (retryFunction != null)
                        SizedBox(
                          width: double.infinity,
                          child: CustomButton(
                              onPressed: () async {
                                ic.setHaveConnection(true);
                                retryFunction();
                              },
                              btText: LocalKeys.retry,
                              isLoading: false),
                        ),
                    ],
                  ),
                ),
              );
      },
    );
  }
}

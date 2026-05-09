import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';
import 'package:xilancer/helper/extension/context_extension.dart';

import '../../utils/components/custom_preloader.dart';

class ProcessStatusView extends StatelessWidget {
  static const routeName = 'process_status_view';
  final String title;
  final String? description;
  final String ebText;
  final void Function(BuildContext context) ebOnTap;
  final String? obText;
  final void Function(BuildContext context)? obOnTap;
  final Function(BuildContext context)? updateFunction;
  final int status;
  final void Function(BuildContext context)? onWillPop;
  final bool updateStatus;
  const ProcessStatusView({
    Key? key,
    required this.title,
    this.description,
    required this.ebText,
    required this.ebOnTap,
    this.obText,
    this.obOnTap,
    this.updateFunction,
    required this.status,
    required this.updateStatus,
    this.onWillPop,
  }) : super(key: key);

  @override
  Widget build(BuildContext context) {
    return FutureBuilder(
        future: updateFunction != null ? updateFunction!(context) : null,
        builder: (context, snapShot) {
          return WillPopScope(
              onWillPop: () async {
                if (snapShot.connectionState == ConnectionState.waiting) {
                  return false;
                }
                if (onWillPop != null) {
                  onWillPop!(context);
                  return false;
                } else {
                  ebOnTap(context);
                  return false;
                }
              },
              child: Scaffold(
                backgroundColor: status == 1 ? context.dProvider.whiteColor : context.dProvider.whiteColor,
                body: Stack(
                  children: [
                    if (status == 1) ...[
                      Positioned(
                        top: -100,
                        right: -100,
                        child: Container(
                          width: 300,
                          height: 300,
                          decoration: BoxDecoration(
                            shape: BoxShape.circle,
                            color: context.dProvider.primaryColor.withOpacity(0.05),
                          ),
                        ),
                      ),
                      Positioned(
                        bottom: -50,
                        left: -50,
                        child: Container(
                          width: 200,
                          height: 200,
                          decoration: BoxDecoration(
                            shape: BoxShape.circle,
                            color: context.dProvider.primaryColor.withOpacity(0.05),
                          ),
                        ),
                      ),
                    ],
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 24),
                      child: Column(
                        mainAxisAlignment: MainAxisAlignment.center,
                        children: [
                          const Spacer(),
                          Center(
                            child: Column(
                              children: [
                                SizedBox(
                                  height: 200,
                                  child: Lottie.asset(
                                    status == 0
                                        ? 'assets/animations/payment_failed.json'
                                        : 'assets/animations/payment_success.json',
                                    repeat: false,
                                  ),
                                ),
                                const SizedBox(height: 24),
                                Text(
                                  title,
                                  textAlign: TextAlign.center,
                                  style: context.titleLarge?.copyWith(
                                    fontSize: 28,
                                    fontWeight: FontWeight.bold,
                                    color: context.dProvider.black2,
                                  ),
                                ),
                                if (description != null) ...[
                                  const SizedBox(height: 12),
                                  Text(
                                    description!,
                                    textAlign: TextAlign.center,
                                    style: context.bodyMedium?.copyWith(
                                      color: context.dProvider.black5,
                                      height: 1.5,
                                    ),
                                  ),
                                ],
                              ],
                            ),
                          ),
                          const Spacer(),
                          if (obText != null)
                            Padding(
                              padding: const EdgeInsets.only(bottom: 12),
                              child: SizedBox(
                                width: double.infinity,
                                height: 56,
                                child: OutlinedButton(
                                  style: OutlinedButton.styleFrom(
                                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                                    side: BorderSide(color: context.dProvider.black8),
                                  ),
                                  onPressed: () => obOnTap?.call(context),
                                  child: Text(
                                    obText!,
                                    style: TextStyle(
                                      color: context.dProvider.black3,
                                      fontWeight: FontWeight.bold,
                                    ),
                                  ),
                                ),
                              ),
                            ),
                          SizedBox(
                            width: double.infinity,
                            height: 56,
                            child: ElevatedButton(
                              style: ElevatedButton.styleFrom(
                                backgroundColor: context.dProvider.primaryColor,
                                foregroundColor: Colors.white,
                                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                                elevation: 0,
                              ),
                              onPressed: () => ebOnTap(context),
                              child: Text(
                                ebText,
                                style: const TextStyle(
                                  fontWeight: FontWeight.bold,
                                  fontSize: 16,
                                ),
                              ),
                            ),
                          ),
                          const SizedBox(height: 32),
                        ],
                      ),
                    ),
                    if (snapShot.connectionState == ConnectionState.waiting)
                      Container(
                        width: double.infinity,
                        height: double.infinity,
                        color: context.dProvider.whiteColor.withOpacity(.7),
                        child: const Center(
                          child: CustomPreloader(),
                        ),
                      ),
                  ],
                ),
              ));
        });
  }
}

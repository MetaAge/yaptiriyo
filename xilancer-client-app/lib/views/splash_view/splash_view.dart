import 'package:flutter/material.dart';
import 'package:flutter_animate/flutter_animate.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/utils/components/custom_preloader.dart';
import '../../helper/local_keys.g.dart';
import '/services/dynamics/dynamics_service.dart';
import '/view_models/splash_view/splash_view_model.dart';
import '/helper/constant_helper.dart';
import '/helper/extension/context_extension.dart';

class SplashView extends StatefulWidget {
  static const routeName = '/';
  const SplashView({super.key});

  @override
  State<SplashView> createState() => _SplashViewState();
}

class _SplashViewState extends State<SplashView> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) async {
      await Future.delayed(2500.ms);
      if (mounted) {
        SplashViewModel().initiateStartingSequence(context);
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    coreInit(context);
    return Material(
      color: Colors.transparent,
      child: SafeArea(
        top: false,
        bottom: false,
        child: SizedBox(
          height: double.infinity,
          width: double.infinity,
          child: Stack(
            alignment: Alignment.center,
            children: [
              Container(
                color: context.dProvider.primaryColor,
                width: double.infinity,
                height: double.infinity,
              ),
              Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  Container(
                    width: 160,
                    height: 160,
                    decoration: const BoxDecoration(
                      color: Colors.white,
                      shape: BoxShape.circle,
                    ),
                    padding: const EdgeInsets.all(2),
                    clipBehavior: Clip.antiAlias,
                    child: Container(
                      decoration: const BoxDecoration(
                        color: Colors.white,
                        shape: BoxShape.circle,
                      ),
                      clipBehavior: Clip.antiAlias,
                      child: Image.asset(
                        'assets/images/app_icon.png',
                        fit: BoxFit.cover,
                      ),
                    ),
                  )
                      .animate()
                      .moveX(
                        begin: context.width,
                        end: 0,
                        duration: 1200.ms,
                        curve: Curves.bounceOut,
                      )
                      .scale(
                        begin: const Offset(0.5, 0.5),
                        end: const Offset(1, 1),
                        duration: 1200.ms,
                        curve: Curves.bounceOut,
                      ),
                  const SizedBox(height: 30),
                  Text(
                    "yaptiriyo",
                    style: GoogleFonts.outfit(
                      fontSize: 44,
                      fontWeight: FontWeight.w800,
                      color: Colors.white,
                      letterSpacing: -1.2,
                    ),
                  )
                      .animate(delay: 600.ms)
                      .fadeIn(duration: 800.ms)
                      .moveY(begin: 30, end: 0, curve: Curves.easeOutBack),
                ],
              ),
              Consumer<DynamicsService>(builder: (context, lProvider, child) {
                return Positioned(
                    bottom: 60,
                    child: lProvider.noConnection
                        ? TextButton(
                            onPressed: () {
                              lProvider.setNoConnection(false);
                              SplashViewModel()
                                  .initiateStartingSequence(context);
                            },
                            style: TextButton.styleFrom(
                              foregroundColor: context.dProvider.primaryColor,
                              backgroundColor: context.dProvider.whiteColor,
                              padding:
                                  const EdgeInsets.symmetric(horizontal: 40),
                              shape: RoundedRectangleBorder(
                                  borderRadius: BorderRadius.circular(12)),
                              surfaceTintColor: Colors.transparent,
                              splashFactory: NoSplash.splashFactory,
                              elevation: 0,
                            ),
                            child: Text(
                              LocalKeys.retry,
                              style: Theme.of(context)
                                  .textTheme
                                  .titleSmall!
                                  .copyWith(
                                      color: context.dProvider.primaryColor),
                            ),
                          )
                        : const CustomPreloader(
                            width: 60,
                            whiteColor: true,
                          ));
              }),
            ],
          ),
        ),
      ),
    );
  }
}

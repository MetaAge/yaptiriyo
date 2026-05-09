import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import '/views/intro_view/components/intro_pages.dart';

import '../../services/intro_service.dart';
import 'components/intro_base.dart';

class IntroView extends StatelessWidget {
  static const routeName = "intro_view";
  const IntroView({super.key});

  @override
  Widget build(BuildContext context) {
    final controller = PageController();
    return Consumer<IntroService>(builder: (context, iProvider, child) {
      return Scaffold(
        backgroundColor: context.dProvider.primaryColor,
        body: Stack(
          children: [
            // Decorative background elements
            Positioned(
              top: -100,
              right: -50,
              child: Container(
                width: 300,
                height: 300,
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  color: Colors.white.withOpacity(0.1),
                ),
              ),
            ),
            Positioned(
              bottom: 100,
              left: -100,
              child: Container(
                width: 400,
                height: 400,
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  color: Colors.white.withOpacity(0.05),
                ),
              ),
            ),
            SafeArea(
              child: Column(
                children: [
                  IntroPages(controller: controller),
                  IntroBase(controller: controller),
                ],
              ),
            ),
          ],
        ),
      );
    });
  }
}

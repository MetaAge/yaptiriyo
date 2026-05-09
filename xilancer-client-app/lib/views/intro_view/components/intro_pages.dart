import 'package:flutter/material.dart';
import 'package:flutter_animate/flutter_animate.dart';
import 'package:provider/provider.dart';

import '../../../services/intro_service.dart';
import '/helper/extension/context_extension.dart';

class IntroPages extends StatelessWidget {
  final PageController controller;
  const IntroPages({super.key, required this.controller});

  @override
  Widget build(BuildContext context) {
    final iProvider = Provider.of<IntroService>(context, listen: false);
    return Expanded(
      child: PageView.builder(
          controller: controller,
          onPageChanged: (index) {
            iProvider.setIndex(index);
          },
          itemCount: iProvider.introData.length,
          itemBuilder: (context, index) {
            final e = iProvider.introData[index];
            return Container(
              padding: const EdgeInsets.symmetric(horizontal: 40),
              child: Column(
                mainAxisAlignment: MainAxisAlignment.center,
                children: [
                  const Spacer(flex: 2),
                  Image.asset(
                    e['image'] as String,
                    height: context.height * 0.35,
                  ).animate(key: ValueKey("img_$index")).fadeIn(duration: 600.ms).slideY(begin: 0.1, end: 0, curve: Curves.easeOutCubic),
                  const Spacer(),
                  Text(
                    (e['title'] as String).toUpperCase(),
                    textAlign: TextAlign.center,
                    style: context.headlineSmall?.copyWith(
                      color: Colors.white,
                      fontSize: 24,
                      fontWeight: FontWeight.w900,
                      letterSpacing: 1.5,
                    ),
                  ).animate(key: ValueKey("ttl_$index")).fadeIn(delay: 200.ms).slideY(begin: 0.2, end: 0),
                  const SizedBox(height: 16),
                  Text(
                    e['description'] as String,
                    textAlign: TextAlign.center,
                    style: context.bodyMedium?.copyWith(
                      color: Colors.white.withOpacity(0.8),
                      fontSize: 16,
                      height: 1.5,
                    ),
                  ).animate(key: ValueKey("dsc_$index")).fadeIn(delay: 400.ms).slideY(begin: 0.2, end: 0),
                  const Spacer(flex: 3),
                ],
              ),
            );
          }),
    );
  }
}

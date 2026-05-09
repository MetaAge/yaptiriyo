import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';
import '/helper/extension/context_extension.dart';

class EmptyWidget extends StatelessWidget {
  const EmptyWidget({
    super.key,
    required this.title,
    this.subtitle,
    this.buttonText,
    this.onButtonPressed,
    this.physics,
    this.margin,
  });

  final String title;
  final String? subtitle;
  final String? buttonText;
  final VoidCallback? onButtonPressed;
  final physics;
  final margin;

  @override
  Widget build(BuildContext context) {
    return Container(
      margin: margin ?? const EdgeInsets.all(20),
      decoration: const BoxDecoration(
          color: Colors.transparent,
      ),
      child: Center(
        child: SingleChildScrollView(
          physics: physics,
          child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              LottieBuilder.asset(
                "assets/animations/empty_list.json",
                width: context.width / 1.5,
                height: context.width / 1.5,
                fit: BoxFit.contain,
                repeat: true,
              ),
              const SizedBox(height: 12),
              Text(
                title,
                textAlign: TextAlign.center,
                style: context.titleLarge?.copyWith(
                  color: context.dProvider.black3,
                  fontWeight: FontWeight.bold,
                  letterSpacing: -0.5,
                ),
              ),
              if (subtitle != null) ...[
                const SizedBox(height: 12),
                Padding(
                  padding: const EdgeInsets.symmetric(horizontal: 40),
                  child: Text(
                    subtitle!,
                    textAlign: TextAlign.center,
                    style: context.bodyMedium?.copyWith(
                      color: context.dProvider.black5,
                      height: 1.5,
                    ),
                  ),
                ),
              ],
              if (buttonText != null && onButtonPressed != null) ...[
                const SizedBox(height: 32),
                InkWell(
                  onTap: onButtonPressed,
                  borderRadius: BorderRadius.circular(16),
                  child: Container(
                    padding: const EdgeInsets.symmetric(horizontal: 32, vertical: 14),
                    decoration: BoxDecoration(
                      color: context.dProvider.primaryColor,
                      borderRadius: BorderRadius.circular(16),
                      boxShadow: [
                        BoxShadow(
                          color: context.dProvider.primaryColor.withOpacity(0.3),
                          blurRadius: 15,
                          offset: const Offset(0, 8),
                        ),
                      ],
                    ),
                    child: Text(
                      buttonText!,
                      style: const TextStyle(
                        color: Colors.white,
                        fontWeight: FontWeight.bold,
                        fontSize: 15,
                      ),
                    ),
                  ),
                ),
              ],
            ],
          ),
        ),
      ),
    );
  }
}

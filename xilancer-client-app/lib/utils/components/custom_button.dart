import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:xilancer/helper/extension/context_extension.dart';

import 'custom_preloader.dart';

class CustomButton extends StatefulWidget {
  final void Function()? onPressed;
  final String btText;
  final bool isLoading;
  final double? height;
  final double? width;
  final Color? backgroundColor;
  final Color? foregroundColor;

  const CustomButton({
    super.key,
    required this.onPressed,
    required this.btText,
    required this.isLoading,
    this.height = 46,
    this.width,
    this.backgroundColor,
    this.foregroundColor,
  });

  @override
  State<CustomButton> createState() => _CustomButtonState();
}

class _CustomButtonState extends State<CustomButton> {
  double _scale = 1.0;

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTapDown: (_) => setState(() => _scale = 0.96),
      onTapUp: (_) => setState(() => _scale = 1.0),
      onTapCancel: () => setState(() => _scale = 1.0),
      child: AnimatedScale(
        scale: _scale,
        duration: const Duration(milliseconds: 100),
        child: SizedBox(
          height: widget.height,
          width: widget.width ?? double.infinity,
          child: ElevatedButton(
            onPressed: widget.onPressed == null
                ? null
                : widget.isLoading
                    ? () {}
                    : () {
                        HapticFeedback.lightImpact();
                        widget.onPressed!();
                      },
            style: ButtonStyle(
              elevation: WidgetStateProperty.all(0),
              shape: WidgetStateProperty.all(RoundedRectangleBorder(borderRadius: BorderRadius.circular(12))),
              backgroundColor: WidgetStateProperty.resolveWith((states) {
                if (states.contains(WidgetState.disabled)) {
                  return (widget.backgroundColor ?? context.dProvider.primaryColor).withOpacity(.7);
                }
                return widget.backgroundColor ?? context.dProvider.primaryColor;
              }),
              foregroundColor: WidgetStateProperty.all(widget.foregroundColor ?? context.dProvider.whiteColor),
            ),
            child: widget.isLoading
                ? SizedBox(
                    height: 24,
                    width: 24,
                    child: CircularProgressIndicator(
                      strokeWidth: 2,
                      color: widget.foregroundColor ?? context.dProvider.whiteColor,
                    ),
                  )
                : Text(
                    widget.btText,
                    style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 15),
                  ),
          ),
        ),
      ),
    );
  }
}

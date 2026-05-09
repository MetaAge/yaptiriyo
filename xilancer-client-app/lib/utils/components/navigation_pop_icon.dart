import 'dart:math';

import 'package:flutter/material.dart';
import '/helper/extension/context_extension.dart';

class NavigationPopIcon extends StatelessWidget {
  final void Function()? onTap;
  final bool hideContainer;
  const NavigationPopIcon({this.onTap, this.hideContainer = false, super.key});

  @override
  Widget build(BuildContext context) {
    return Transform.rotate(
      angle: context.dProvider.textDirectionRight ? pi : 0,
      child: GestureDetector(
        onTap: () {
          if (onTap == null) {
            context.popTrue;
            return;
          }
          onTap!();
        },
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            if (hideContainer)
              Icon(
                Icons.arrow_back_rounded,
                size: 24,
                color: context.dProvider.blackColor,
              )
            else
              Container(
                height: 32,
                width: 32,
                alignment: Alignment.center,
                decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(8),
                  border: Border.all(color: context.dProvider.black7),
                ),
                child: Icon(
                  Icons.arrow_back_rounded,
                  size: 16,
                  color: context.dProvider.blackColor,
                ),
              ),
          ],
        ),
      ),
    );
  }
}

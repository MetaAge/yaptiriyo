import 'package:flutter/material.dart';
import '../../../helper/extension/int_extension.dart';
import '/helper/extension/context_extension.dart';
import '/helper/extension/string_extension.dart';

class ProfileMenuTile extends StatelessWidget {
  final String title;
  final String svg;
  final void Function() onPress;
  final Color? iconColor;
  const ProfileMenuTile({
    required this.title,
    required this.svg,
    required this.onPress,
    this.iconColor,
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    return InkWell(
      onTap: onPress,
      child: Container(
        height: 64,
        padding: const EdgeInsets.symmetric(horizontal: 20),
        decoration: BoxDecoration(
          color: context.dProvider.whiteColor,
          border: Border(
            bottom: BorderSide(
              color: context.dProvider.black8.withOpacity(0.5),
              width: 0.5,
            ),
          ),
        ),
        child: Row(children: [
          Container(
            padding: const EdgeInsets.all(10),
            decoration: BoxDecoration(
              color: (iconColor ?? context.dProvider.primaryColor).withOpacity(0.1),
              shape: BoxShape.circle,
            ),
            child: svg.toSVGSized(18, color: iconColor ?? context.dProvider.primaryColor),
          ),
          16.toWidth,
          Expanded(
            child: Text(
              title,
              style: context.titleMedium?.bold5.copyWith(
                color: context.dProvider.black2,
                fontSize: 15,
              ),
            ),
          ),
          Icon(
            Icons.chevron_right_rounded,
            color: context.dProvider.black6,
            size: 20,
          ),
        ]),
      ),
    );
  }
}

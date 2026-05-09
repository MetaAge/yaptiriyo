import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';

import '../../../helper/constant_helper.dart';
import '../../../helper/local_keys.g.dart';

class ProTag extends StatelessWidget {
  final bool isPro;
  final DateTime? proExpDate;
  const ProTag({super.key, required this.isPro, this.proExpDate});

  @override
  Widget build(BuildContext context) {
    final DateTime now = DateTime.now();
    if (!isPro || now.isAfter(proExpDate ?? now.subtract(Duration(days: 1)))) {
      return SizedBox();
    }
    return Container(
      margin: EdgeInsets.all(8),
      padding: EdgeInsets.symmetric(horizontal: 12, vertical: 6),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(40),
        color: Colors.pink[050],
      ),
      child: FittedBox(
        child: Row(
          children: [
            Container(
                padding: EdgeInsets.all(2),
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  color: Colors.pink,
                ),
                child: Icon(
                  Icons.done_rounded,
                  size: 14,
                  color: dProvider.whiteColor,
                )),
            SizedBox(width: 8),
            Text(
              LocalKeys.pro,
              style: context.titleSmall?.bold.copyWith(
                color: Colors.pink,
              ),
            ),
          ],
        ),
      ),
    );
  }
}

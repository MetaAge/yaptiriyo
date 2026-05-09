import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

extension SizedBoxExtension on int {
  Widget get toHeight {
    return SizedBox(
      height: toDouble(),
    );
  }

  Widget get toWidth {
    return SizedBox(
      width: toDouble(),
    );
  }
}

extension CurrencyExtension on double {
  String get cur {
    return toStringAsFixed(2).cur;
  }
}

extension ListAverage on List {
  num get calculateAverage {
    if (isEmpty) {
      return 0;
    }

    num sum = reduce((a, b) => (a as num) + (b as num));
    return sum / length;
  }
}

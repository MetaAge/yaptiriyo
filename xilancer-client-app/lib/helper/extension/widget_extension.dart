import 'package:flutter/material.dart';
import 'package:flutter_animate/flutter_animate.dart';

extension WidgetExtension on Widget {
  Widget get toSliver {
    return SliverToBoxAdapter(child: this);
  }
}

extension CreateShimmerExtension on Widget {
  Widget get shim {
    return animate(
      delay: 0.ms,
      autoPlay: true,
      onPlay: (controller) => controller.repeat(),
    ).shimmer(
      duration: 1500.ms,
      color: Colors.white.withOpacity(0.3),
      angle: 45,
    ).fadeIn(duration: 300.ms);
  }
}

extension PaddingExtension on Widget {
  Widget get hp20 {
    return Padding(
      padding: const EdgeInsets.symmetric(horizontal: 20),
      child: this,
    );
  }
}

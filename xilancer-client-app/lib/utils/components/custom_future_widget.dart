import 'package:flutter/material.dart';

class CustomFutureWidget extends StatelessWidget {
  final child;
  final shimmer;
  final isLoading;
  final function;
  final Function(dynamic data)? onDataFetched;
  const CustomFutureWidget(
      {super.key,
      required this.child,
      this.function,
      this.shimmer,
      this.isLoading,
      this.onDataFetched});

  @override
  Widget build(BuildContext context) {
    return FutureBuilder(
      future: function,
      builder: (context, snapshot) {
        if ((snapshot.connectionState == ConnectionState.waiting ||
                isLoading == true) &&
            shimmer != null) {
          return shimmer;
        }

        if (snapshot.connectionState == ConnectionState.done &&
            snapshot.hasData &&
            onDataFetched != null) {
          WidgetsBinding.instance.addPostFrameCallback((_) {
            onDataFetched!(snapshot.data);
          });
        }

        return child;
      },
    );
  }
}

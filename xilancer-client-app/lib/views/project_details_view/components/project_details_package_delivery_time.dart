import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/views/project_details_view/components/package_detail_row.dart';

import '../../../view_models/project_details_view_model/project_details_view_model.dart';

class ProjectDetailsPackageDeliveryTime extends StatelessWidget {
  const ProjectDetailsPackageDeliveryTime({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    final pdm = ProjectDetailsViewModel.instance;
    return ValueListenableBuilder(
      valueListenable: pdm.packageIndex,
      builder: (context, value, child) {
        final deliveryTime = pdm.packages.isNotEmpty && value < pdm.packages.length
            ? pdm.packages[value].deliveryTime.toString()
                .replaceAll("Days", "Gün")
                .replaceAll("Day", "Gün")
                .replaceAll("days", "gün")
                .replaceAll("day", "gün")
                .replaceAll("Hours", "Saat")
                .replaceAll("Hour", "Saat")
                .replaceAll("hours", "saat")
                .replaceAll("hour", "saat")
                .replaceAll("Minutes", "Dakika")
                .replaceAll("Minute", "Dakika")
            : "---";
        return PackageDetailRow(
          label: LocalKeys.deliveryTime,
          value: deliveryTime,
          icon: Icon(
            Icons.access_time_rounded,
            color: context.dProvider.primaryColor,
            size: 20,
          ),
        );
      },
    );
  }
}

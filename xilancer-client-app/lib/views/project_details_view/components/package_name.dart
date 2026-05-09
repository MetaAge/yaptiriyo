import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/views/project_details_view/components/package_detail_row.dart';

import '../../../view_models/project_details_view_model/project_details_view_model.dart';

class PackageName extends StatelessWidget {
  const PackageName({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    final pdm = ProjectDetailsViewModel.instance;
    return ValueListenableBuilder(
        valueListenable: pdm.packageIndex,
        builder: (context, index, child) {
          final packageName = pdm.packages.isNotEmpty && index < pdm.packages.length
              ? pdm.packages[index].name.tr()
              : "---";
          return PackageDetailRow(
            label: LocalKeys.name,
            value: packageName,
            icon: Icon(
              Icons.inventory_2_rounded,
              color: context.dProvider.primaryColor,
              size: 20,
            ),
          );
        });
  }
}

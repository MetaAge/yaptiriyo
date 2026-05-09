import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/views/project_details_view/components/package_detail_row.dart';

import '../../../view_models/project_details_view_model/project_details_view_model.dart';

class ProjectDetailsPackageRevisions extends StatelessWidget {
  const ProjectDetailsPackageRevisions({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    final pdm = ProjectDetailsViewModel.instance;
    return ValueListenableBuilder(
      valueListenable: pdm.packageIndex,
      builder: (context, value, child) {
        final revisions = pdm.packages.isNotEmpty && value < pdm.packages.length
            ? pdm.packages[value].revision.toString()
            : "0";
        return PackageDetailRow(
          label: LocalKeys.revisions,
          value: revisions,
          icon: Icon(
            Icons.refresh_rounded,
            color: context.dProvider.primaryColor,
            size: 20,
          ),
        );
      },
    );
  }
}

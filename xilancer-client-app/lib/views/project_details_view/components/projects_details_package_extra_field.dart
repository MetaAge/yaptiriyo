import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/view_models/project_details_view_model/project_details_view_model.dart';
import 'package:xilancer/views/project_details_view/components/package_detail_row.dart';

import '../../../models/packages_model.dart';

class ProjectDetailsPackageExtraField extends StatelessWidget {
  final int index;

  ProjectDetailsPackageExtraField({
    super.key,
    required this.pdm,
    required this.index,
  });
  final ProjectDetailsViewModel pdm;

  TextEditingController nameController = TextEditingController();
  @override
  Widget build(BuildContext context) {
    final pdm = ProjectDetailsViewModel.instance;
    final packageIndex = pdm.packageIndex.value;

    if (pdm.packages.isEmpty ||
        packageIndex >= pdm.packages.length ||
        index >= pdm.packages[packageIndex].extraFields.length) {
      return const SizedBox();
    }

    final extraField = pdm.packages[packageIndex].extraFields[index];
    nameController.text = extraField.name;
    return PackageDetailRow(
      label: extraField.name,
      trailing: extraField.type == FieldType.CHECK
          ? Container(
              padding: const EdgeInsets.all(6),
              decoration: BoxDecoration(
                shape: BoxShape.circle,
                color: extraField.checked
                    ? const Color(0xFF22C55E).withOpacity(0.12)
                    : const Color(0xFFEF4444).withOpacity(0.12),
              ),
              child: Icon(
                extraField.checked ? Icons.done_rounded : Icons.close_rounded,
                color: extraField.checked
                    ? const Color(0xFF22C55E)
                    : const Color(0xFFEF4444),
                size: 14,
              ),
            )
          : null,
      value: extraField.type == FieldType.CHECK
          ? null
          : extraField.quantity.toString(),
      icon: Icon(
        extraField.type == FieldType.CHECK
            ? Icons.check_circle_outline_rounded
            : Icons.add_circle_outline_rounded,
        color: context.dProvider.primaryColor,
        size: 20,
      ),
    );
  }
}

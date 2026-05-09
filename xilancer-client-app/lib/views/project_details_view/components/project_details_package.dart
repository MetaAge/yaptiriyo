import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';

import '../../../view_models/project_details_view_model/project_details_view_model.dart';
import 'project_details_package_delivery_time.dart';
import 'projects_details_package_extra_field.dart';
import 'package_name.dart';
import 'project_details_package_revisions.dart';
import 'packages_list.dart';

class ProjectDetailsPackages extends StatelessWidget {
  final projectId;
  const ProjectDetailsPackages({super.key, this.projectId});

  @override
  Widget build(BuildContext context) {
    final pdm = ProjectDetailsViewModel.instance;
    return FutureBuilder(
        future: pdm.initPackage(context, projectId),
        builder: (context, snap) {
          if (snap.connectionState == ConnectionState.waiting) {
            return const SizedBox();
          }
          return Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              const PackagesList(),
              Container(
                margin: const EdgeInsets.symmetric(horizontal: 20),
                decoration: BoxDecoration(
                  color: context.dProvider.whiteColor,
                  borderRadius: BorderRadius.circular(16),
                  boxShadow: [
                    BoxShadow(
                      color: Colors.black.withOpacity(0.04),
                      blurRadius: 30,
                      spreadRadius: 2,
                      offset: const Offset(0, 10),
                    ),
                  ],
                ),
                clipBehavior: Clip.antiAlias,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    const PackageName(),
                    const Divider(height: 1),
                    const ProjectDetailsPackageRevisions(),
                    const Divider(height: 1),
                    const ProjectDetailsPackageDeliveryTime(),
                    ValueListenableBuilder(
                        valueListenable: pdm.packageIndex,
                        builder: (context, ind, child) {
                          int index = 0;
                          return Column(
                            children: pdm.packages.isNotEmpty &&
                                    ind < pdm.packages.length
                                ? pdm.packages[ind]
                                    .extraFields
                                    .map((e) => Column(
                                          children: [
                                            const Divider(height: 1),
                                            ProjectDetailsPackageExtraField(
                                              pdm: pdm,
                                              index: index++,
                                            ),
                                          ],
                                        ))
                                    .toList()
                                : [],
                          );
                        }),
                  ],
                ),
              ),
            ],
          );
        });
  }
}

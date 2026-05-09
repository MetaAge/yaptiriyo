import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/widget_extension.dart';
import 'package:xilancer/services/create_project_service.dart';
import 'package:xilancer/view_models/create_project_view_model/create_project_view_model.dart';
import 'package:xilancer/views/create_project_view_freelancer/components/package_delivery_time.dart';
import 'package:xilancer/views/create_project_view_freelancer/components/package_extra_field.dart';
import 'package:xilancer/views/create_project_view_freelancer/components/package_name.dart';
import 'package:xilancer/views/create_project_view_freelancer/components/package_price.dart';
import 'package:xilancer/views/create_project_view_freelancer/components/package_revisions.dart';
import 'package:xilancer/views/create_project_view_freelancer/components/packages_list.dart';
import 'package:xilancer/views/create_project_view_freelancer/components/packages_switch.dart';
import 'create_project_buttons.dart';

class ProjectPackages extends StatelessWidget {
  const ProjectPackages({super.key});

  @override
  Widget build(BuildContext context) {
    final cpv = CreateProjectViewModel.instance;
    int index = 0;
    return ValueListenableBuilder(
      valueListenable: cpv.currentPackageIndex,
      builder: (context, cIndex, child) {
        return ValueListenableBuilder(
            valueListenable: cpv.packages,
            builder: (context, packages, child) {
              final package = packages[cIndex.round()];
              debugPrint("package revision is ${package.revision}".toString());
              debugPrint(
                  "package delivery is ${package.deliveryTime}".toString());
              return SingleChildScrollView(
                child: Column(
                  children: [
                    Container(
                      margin: const EdgeInsets.all(20),
                      padding: const EdgeInsets.symmetric(vertical: 24),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(24),
                        color: context.dProvider.whiteColor,
                        border: Border.all(color: context.dProvider.black8.withOpacity(0.5)),
                        boxShadow: [
                          BoxShadow(
                            color: Colors.black.withOpacity(0.04),
                            blurRadius: 20,
                            offset: const Offset(0, 10),
                          ),
                        ],
                      ),
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          PackagesSwitch(cpv: cpv),
                          const SizedBox(height: 16),
                          PackagesList(cpv: cpv),
                          const SizedBox(height: 16),
                          Divider(color: context.dProvider.black8, thickness: 1),
                          const SizedBox(height: 24),
                          Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              PackageName(
                                package: package,
                              ),
                              PackageRevisions(
                                cpv: cpv,
                                package: package,
                                index: cIndex,
                              ),
                              PackageDeliveryTime(
                                cpv: cpv,
                                package: package,
                                index: cIndex,
                              ),
                              ValueListenableBuilder(
                                valueListenable: cpv.extraFields,
                                builder: (context, value, child) {
                                  return Column(
                                    children: cpv.extraFields.value
                                        .map((e) => PackageExtraField(
                                              cpv: cpv,
                                              index: index,
                                              extraField: e,
                                            ))
                                        .toList(),
                                  );
                                },
                              ),
                              const SizedBox(height: 16),
                              Divider(
                                color: context.dProvider.black8,
                                height: 1,
                              ),
                              const SizedBox(height: 24),
                              PackagePrice(
                                package: package,
                                cpv: cpv,
                              ),
                            ],
                          ),
                          const SizedBox(height: 32),
                          CreateProjectButtons().hp20,
                        ],
                      ),
                    ),
                    const SizedBox(height: 32),
                  ],
                ),
              );
            });
      },
    );
  }
}

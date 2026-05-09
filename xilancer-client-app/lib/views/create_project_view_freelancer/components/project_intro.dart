import 'package:flutter/material.dart';
import 'package:flutter_summernote/flutter_summernote.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/widget_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/utils/components/category_dropdown.dart';
import 'package:xilancer/utils/components/field_with_label.dart';
import 'add_subcategory.dart';
import 'subcategory_chip.dart';

import '../../../utils/components/field_label.dart';
import '../../../view_models/create_project_view_model/create_project_view_model.dart';
import 'create_project_buttons.dart';
import 'project_service_area_selector.dart';


class ProjectIntro extends StatelessWidget {
  final CreateProjectViewModel cpv;
  const ProjectIntro({
    super.key,
    required this.cpv,
  });

  @override
  Widget build(BuildContext context) {
    final cpm = CreateProjectViewModel.instance;
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
                Text(
                  LocalKeys.projectIntro,
                  style: context.titleMedium?.copyWith(
                    fontWeight: FontWeight.bold,
                    color: context.dProvider.black2,
                  ),
                ).hp20,
                const SizedBox(height: 16),
                Divider(
                  color: context.dProvider.black8,
                  thickness: 1,
                  height: 1,
                ),
                const SizedBox(height: 24),
                Column(
                  children: [
                    Form(
                      key: cpm.introFormKey,
                      child: Column(
                        crossAxisAlignment: CrossAxisAlignment.start,
                        children: [
                          CategoryDropdown(
                            catNotifier: cpm.selectedCategory,
                            isRequired: true,
                            isEnabled: cpm.id == null,
                          ),
                          if (cpm.id != null)
                            Padding(
                              padding: const EdgeInsets.only(top: 8, bottom: 4),
                              child: Text(
                                LocalKeys.mainCategoryWarning,
                                style: context.titleSmall?.copyWith(
                                  color: context.dProvider.warningColor,
                                  fontSize: 12,
                                ),
                              ),
                            ),
                          16.toHeight,

                          FieldLabel(
                            label: LocalKeys.subcategory,
                            isRequired: true,
                          ),
                          ValueListenableBuilder(
                            valueListenable: cpm.selectedSubcategories,
                            builder: (context, value, child) {
                              return Container(
                                  width: double.infinity,
                                  padding: const EdgeInsets.all(12),
                                  decoration: BoxDecoration(
                                    borderRadius: BorderRadius.circular(16),
                                    color: context.dProvider.black9,
                                    border: Border.all(color: context.dProvider.black8.withOpacity(0.5)),
                                  ),
                                  constraints: const BoxConstraints(minHeight: 100),
                                  child: Wrap(
                                    spacing: 10,
                                    runSpacing: 10,
                                    children: [
                                      ...cpm.selectedSubcategories.value
                                          .map((e) =>
                                              SubCategoryChip(subcategory: e))
                                          .toList(),
                                      const AddSubCategory(),
                                    ],
                                  ));
                            },
                          ),
                          16.toHeight,

                          const ProjectServiceAreaSelector(),

                          FieldWithLabel(
                            label: LocalKeys.whatAreYouOfferingToClients,
                            hintText: LocalKeys.writeServiceTitle,
                            controller: cpm.titleController,
                            isRequired: true,
                            onChanged: (value) {},
                            validator: (value) {
                              return value.toString().isEmpty
                                  ? LocalKeys.writeServiceTitle
                                  : null;
                            },
                          ),
                          12.toHeight,
                          FieldLabel(
                            label: LocalKeys.writeADescriptionAboutYourProject,
                            isRequired: true,
                          ),
                        ],
                      ).hp20,
                    ),
                    const SizedBox(height: 8),
                    Container(
                      margin: const EdgeInsets.symmetric(horizontal: 20),
                      decoration: BoxDecoration(
                        borderRadius: BorderRadius.circular(16),
                        border: Border.all(
                          color: context.dProvider.black8,
                          width: 1,
                        ),
                      ),
                      clipBehavior: Clip.antiAlias,
                      child: FlutterSummernote(
                        hint: cpm.descriptionController.text.isEmpty
                            ? LocalKeys.writeProjectDescription
                            : null,
                        hasAttachment: false,
                        value: cpm.descriptionController.text,
                        height: 360,
                        showBottomToolbar: false,
                        decoration: BoxDecoration(
                          borderRadius: BorderRadius.circular(16),
                        ),
                        returnContent: (value) {
                          cpm.descriptionController.text = value;
                          debugPrint(value.toString());
                        },
                        key: cpv.keyEditor,
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 24),
                CreateProjectButtons().hp20,
              ],
            ),
          ),
          const SizedBox(height: 32),
        ],
      ),
    );
  }
}

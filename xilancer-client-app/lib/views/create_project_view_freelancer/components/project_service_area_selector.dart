import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/models/city_dropdown_model.dart';
import 'package:xilancer/models/country_model.dart';
import 'package:xilancer/models/project_details_model.dart';
import 'package:xilancer/models/state_model.dart';
import 'package:xilancer/utils/components/city_dropdown.dart';
import 'package:xilancer/utils/components/state_dropdown.dart';
import 'package:xilancer/view_models/create_project_view_model/create_project_view_model.dart';

class ProjectServiceAreaSelector extends StatefulWidget {
  const ProjectServiceAreaSelector({super.key});

  @override
  State<ProjectServiceAreaSelector> createState() =>
      _ProjectServiceAreaSelectorState();
}

class _ProjectServiceAreaSelectorState
    extends State<ProjectServiceAreaSelector> {
  final cpm = CreateProjectViewModel.instance;

  @override
  Widget build(BuildContext context) {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children: [
            Text(
              LocalKeys.serviceAreasMandatory,
              style: context.titleSmall?.bold6,
            ),
            TextButton.icon(
              onPressed: () {
                cpm.isAllServiceAreasSelected.value = false;
                _showAddAreaSheet(context);
              },
              icon: const Icon(Icons.add_circle_outline, size: 20),
              label: Text(LocalKeys.add),
            ),
          ],
        ),
        ValueListenableBuilder(
          valueListenable: cpm.isAllServiceAreasSelected,
          builder: (context, bool isAll, child) {
            return Row(
              children: [
                SizedBox(
                  height: 24,
                  width: 24,
                  child: Checkbox(
                    value: isAll,
                    onChanged: (val) {
                      cpm.isAllServiceAreasSelected.value = val ?? false;
                      if (val == true) {
                        cpm.selectedServiceAreas.value = [];
                      }
                    },
                    activeColor: context.dProvider.primaryColor,
                  ),
                ),
                8.toWidth,
                GestureDetector(
                  onTap: () {
                    cpm.isAllServiceAreasSelected.value = !isAll;
                    if (cpm.isAllServiceAreasSelected.value) {
                      cpm.selectedServiceAreas.value = [];
                    }
                  },
                  child: Text(
                    LocalKeys.allServiceAreas,
                    style: context.bodySmall?.copyWith(
                      color: isAll
                          ? context.dProvider.primaryColor
                          : context.dProvider.black5,
                      fontWeight: isAll ? FontWeight.bold : FontWeight.normal,
                    ),
                  ),
                ),
              ],
            );
          },
        ),
        8.toHeight,
        AnimatedBuilder(
          animation: Listenable.merge(
              [cpm.selectedServiceAreas, cpm.isAllServiceAreasSelected]),
          builder: (context, child) {
            final areas = cpm.selectedServiceAreas.value;
            final isAll = cpm.isAllServiceAreasSelected.value;
            if (isAll) return const SizedBox();
            if (areas.isEmpty) {
              return Padding(
                padding: const EdgeInsets.symmetric(vertical: 8.0),
                child: Text(
                  LocalKeys.noAreasAdded,
                  style: context.titleSmall
                      ?.copyWith(color: Colors.grey, fontSize: 12),
                ),
              );
            }
            return Wrap(
              spacing: 8,
              children: areas.map((area) {
                final sa = area as ServiceArea;
                String label = sa.state?.name ?? LocalKeys.stateNotSelected;
                if (sa.city != null) {
                  label += " - ${sa.city.name}";
                }
                return Chip(
                  label: Text(label, style: const TextStyle(fontSize: 12)),
                  onDeleted: () {
                    final newList =
                        List<dynamic>.from(cpm.selectedServiceAreas.value);
                    newList.remove(area);
                    cpm.selectedServiceAreas.value = newList;
                  },
                  deleteIconColor: Colors.red,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(20),
                  ),
                );
              }).toList(),
            );
          },
        ),
        16.toHeight,
      ],
    );
  }

  void _showAddAreaSheet(BuildContext context) {
    final countryNotifier = ValueNotifier<Country?>(Country(id: 15, name: "Turkey"));
    final stateNotifier = ValueNotifier<States?>(null);
    final cityNotifier = ValueNotifier<City?>(null);

    showModalBottomSheet(
      context: context,
      isScrollControlled: true,
      backgroundColor: Colors.transparent,
      builder: (context) {
        return Container(
          decoration: BoxDecoration(
            color: context.dProvider.whiteColor,
            borderRadius: const BorderRadius.vertical(top: Radius.circular(20)),
          ),
          padding: EdgeInsets.only(
            bottom: MediaQuery.of(context).viewInsets.bottom + 20,
            left: 20,
            right: 20,
            top: 20,
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(LocalKeys.addNewServiceArea, style: context.titleMedium?.bold6),
              16.toHeight,
              StateDropdown(
                countryNotifier: countryNotifier,
                stateNotifier: stateNotifier,
                label: LocalKeys.selectStatePrompt,
                onChanged: (States? s) {
                  cityNotifier.value = null;
                },
              ),
              CityDropdown(
                stateNotifier: stateNotifier,
                cityNotifier: cityNotifier,
                label: LocalKeys.selectCityOptional,
              ),
              20.toHeight,
              SizedBox(
                width: double.infinity,
                child: ElevatedButton(
                  onPressed: () {
                    if (stateNotifier.value == null) {
                      LocalKeys.pleaseSelectAState.showToast();
                      return;
                    }
                    
                    final newArea = ServiceArea(
                      countryId: 15,
                      stateId: stateNotifier.value?.id,
                      cityId: cityNotifier.value?.id,
                      state: stateNotifier.value,
                      city: cityNotifier.value,
                    );

                    // Avoid duplicates
                    bool exists = cpm.selectedServiceAreas.value.any((element) {
                      final e = element as ServiceArea;
                      return e.stateId == newArea.stateId && e.cityId == newArea.cityId;
                    });

                    if (exists) {
                      LocalKeys.areaAlreadyAdded.showToast();
                      return;
                    }

                    final newList = List<dynamic>.from(cpm.selectedServiceAreas.value);
                    newList.add(newArea);
                    cpm.selectedServiceAreas.value = newList;
                    
                    Navigator.pop(context);
                  },
                  child: Text(LocalKeys.add),
                ),
              ),
            ],
          ),
        );
      },
    );
  }
}

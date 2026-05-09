import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/utils/components/city_dropdown.dart';
import 'package:xilancer/utils/components/country_dropdown.dart';
import 'package:xilancer/utils/components/state_dropdown.dart';
import '../../../helper/local_keys.g.dart';

import '../../../models/state_model.dart';
import '../../../view_models/home_drawer_view_model/home_drawer_view_model.dart';

class FilterPlace extends StatelessWidget {
  const FilterPlace({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    final hdm = HomeDrawerViewModel.instance;
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(8),
        color: context.dProvider.whiteColor,
      ),
      child: Column(
        children: [
          StateDropdown(
            countryNotifier: hdm.selectedCountry,
            stateNotifier: hdm.selectedState,
            label: LocalKeys.state,
            hintText: LocalKeys.selectState,
            textStyle: context.titleSmall
                ?.copyWith(color: context.dProvider.blackColor),
            onChanged: (States? s) {
              hdm.selectedCity.value = null;
            },
          ),
          ValueListenableBuilder(
            valueListenable: hdm.selectedState,
            builder: (context, s, child) {
              if (s == null || s.id == null) {
                return const SizedBox();
              }
              return CityDropdown(
                stateNotifier: hdm.selectedState,
                cityNotifier: hdm.selectedCity,
                label: LocalKeys.district,
                hintText: LocalKeys.selectDistrict,
                textStyle: context.titleSmall
                    ?.copyWith(color: context.dProvider.blackColor),
              );
            },
          ),
        ],
      ),
    );
  }
}

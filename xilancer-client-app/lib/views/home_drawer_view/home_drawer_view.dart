import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/utils/components/field_label.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/views/home_drawer_view/components/filter_buttons.dart';
import 'package:xilancer/views/home_drawer_view/components/filter_ratings.dart';

import '../../view_models/home_drawer_view_model/home_drawer_view_model.dart';
import 'components/filter_budget_range.dart';
import 'components/filter_categories.dart';
import 'components/filter_lengths.dart';
import 'components/filter_place.dart';

class HomeDrawerView extends StatelessWidget {
  const HomeDrawerView({super.key});

  @override
  Widget build(BuildContext context) {
    final hdm = HomeDrawerViewModel.instance;
    return Container(
      decoration: BoxDecoration(
        color: context.dProvider.black9,
      ),
      child: Column(
        children: [
          AppBar(
            backgroundColor: context.dProvider.whiteColor,
            elevation: 0,
            leading: const NavigationPopIcon(),
            title: Text(LocalKeys.filter,
                style: context.titleLarge?.copyWith(
                  color: context.dProvider.black2,
                  fontWeight: FontWeight.bold,
                )),
          ),
          Expanded(
              child: ListView(
            padding: const EdgeInsets.symmetric(horizontal: 20, vertical: 10),
            children: [
              ValueListenableBuilder(
                valueListenable: hdm.proProjects,
                builder: (context, value, child) => Container(
                  decoration: BoxDecoration(
                    color: context.dProvider.whiteColor,
                    borderRadius: BorderRadius.circular(16),
                    border: Border.all(color: context.dProvider.black8),
                  ),
                  child: ListTile(
                    contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 4),
                    title: Text(
                      LocalKeys.proProjects,
                      style: context.titleSmall?.copyWith(
                        fontWeight: FontWeight.bold,
                        color: context.dProvider.black3,
                      ),
                    ),
                    trailing: Switch.adaptive(
                        activeColor: context.dProvider.primaryColor,
                        value: value,
                        onChanged: (_) {
                          hdm.proProjects.value = !value;
                        }),
                  ),
                ),
              ),
              12.toHeight,
              const FilterCategories(),
              12.toHeight,
              const FilterPlace(),
              12.toHeight,
              const FilterBudgetRange(),
              12.toHeight,
              const FilterRatings(),
            ],
          )),
          Divider(
            color: context.dProvider.black8,
            thickness: 2,
            height: 2,
          ),
          const FilterButtons()
        ],
      ),
    );
  }
}

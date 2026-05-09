import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

import '../../../view_models/project_details_view_model/project_details_view_model.dart';

class PackagesList extends StatelessWidget {
  const PackagesList({
    super.key,
  });

  @override
  Widget build(BuildContext context) {
    final pdm = ProjectDetailsViewModel.instance;
    return Container(
      width: context.width,
      height: 70,
      padding: const EdgeInsets.symmetric(vertical: 12),
      child: ListView.separated(
          shrinkWrap: true,
          scrollDirection: Axis.horizontal,
          padding: const EdgeInsets.symmetric(horizontal: 20),
          itemBuilder: (context, index) {
            return ValueListenableBuilder(
              valueListenable: pdm.packageIndex,
              builder: (context, ind, child) => GestureDetector(
                onTap: () {
                  FocusScope.of(context).unfocus();
                  pdm.packageIndex.value = index;
                },
                child: AnimatedContainer(
                  duration: const Duration(milliseconds: 300),
                  height: 46,
                  alignment: Alignment.center,
                  padding: const EdgeInsets.symmetric(horizontal: 24),
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(16),
                    color: ind == index
                        ? context.dProvider.primaryColor
                        : context.dProvider.whiteColor,
                    boxShadow: ind == index ? [
                      BoxShadow(
                        color: context.dProvider.primaryColor.withOpacity(0.3),
                        blurRadius: 10,
                        offset: const Offset(0, 4),
                      )
                    ] : [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.03),
                        blurRadius: 5,
                        offset: const Offset(0, 2),
                      )
                    ],
                    border: Border.all(
                      color: ind == index ? context.dProvider.primaryColor : context.dProvider.black8,
                      width: 1,
                    )
                  ),
                  child: Text(
                    pdm.packages[index].name.tr(),
                    style: context.titleSmall?.copyWith(
                        fontWeight: ind == index ? FontWeight.w800 : FontWeight.w600,
                        fontSize: 14,
                        color: ind == index
                            ? context.dProvider.whiteColor
                            : context.dProvider.black5),
                  ),
                ),
              ),
            );
          },
          separatorBuilder: (context, index) => 12.toWidth,
          itemCount: pdm.packages.length),
    );
  }
}

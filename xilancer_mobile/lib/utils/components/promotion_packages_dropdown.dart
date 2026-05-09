import 'dart:async';

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/models/promotion_packages_model.dart';

import '../../helper/extension/context_extension.dart';
import '../../helper/extension/string_extension.dart';
import '../../helper/local_keys.g.dart';
import '../../helper/svg_assets.dart';
import '../../services/promotion_packages_service.dart';
import '../../utils/components/custom_preloader.dart';
import '../../utils/components/field_label.dart';
import 'empty_spacer_helper.dart';

class PromotionPackagesDropdown extends StatelessWidget {
  final String? hintText;
  final String? textFieldHint;
  final onChanged;
  final iconColor;
  final textStyle;
  final isRequired;
  final ValueNotifier<PromotionPackages?> packageNotifier;
  PromotionPackagesDropdown(
      {this.hintText,
      this.onChanged,
      this.textFieldHint,
      this.iconColor,
      this.textStyle,
      this.isRequired,
      required this.packageNotifier,
      super.key});

  final ScrollController controller = ScrollController();
  Timer? scheduleTimeout;
  @override
  Widget build(BuildContext context) {
    return ValueListenableBuilder(
      valueListenable: packageNotifier,
      builder: (context, selectedValue, child) => Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          FieldLabel(
              label: LocalKeys.chosePackage, isRequired: isRequired ?? false),
          InkWell(
            onTap: () {
              Provider.of<PromotionPackagesService>(context, listen: false)
                  .resetList();
              showModalBottomSheet(
                context: context,
                backgroundColor: Colors.transparent,
                isScrollControlled: true,
                builder: (context) {
                  controller.addListener(() {
                    tryLoadingMore(context);
                  });
                  return Container(
                    decoration: BoxDecoration(
                      borderRadius: BorderRadius.circular(20),
                      color: context.dProvider.whiteColor,
                    ),
                    constraints: BoxConstraints(
                        maxHeight: context.height / 2 +
                            (MediaQuery.of(context).viewInsets.bottom / 2)),
                    child: Consumer<PromotionPackagesService>(
                        builder: (context, cProvider, child) {
                      return Column(
                        children: [
                          Align(
                            alignment: Alignment.center,
                            child: Container(
                              height: 4,
                              width: 48,
                              margin: const EdgeInsets.all(8),
                              decoration: BoxDecoration(
                                borderRadius: BorderRadius.circular(12),
                                color: context.dProvider.black7,
                              ),
                            ),
                          ),
                          Expanded(
                            child: ListView.separated(
                                controller: controller,
                                shrinkWrap: true,
                                padding: const EdgeInsets.only(
                                    right: 20, left: 20, bottom: 20),
                                itemBuilder: (context, index) {
                                  if (cProvider.packagesLoading ||
                                      (cProvider.packagesDropdownList.length ==
                                              index &&
                                          cProvider.nextPage != null)) {
                                    return const SizedBox(
                                        height: 50,
                                        width: double.infinity,
                                        child:
                                            Center(child: CustomPreloader()));
                                  }
                                  if (cProvider.packagesDropdownList.isEmpty) {
                                    return SizedBox(
                                      width: context.width - 60,
                                      height: 64,
                                      child: Center(
                                        child: Text(
                                          LocalKeys.noResultFound,
                                          style: textStyle,
                                        ),
                                      ),
                                    );
                                  }
                                  if (cProvider.packagesDropdownList.length ==
                                      index) {
                                    return SizedBox(
                                      width: context.width - 60,
                                      height: 64,
                                      child: Center(
                                        child: Text(
                                          LocalKeys.noResultFound,
                                          style: textStyle,
                                        ),
                                      ),
                                    );
                                  }
                                  final element =
                                      cProvider.packagesDropdownList[index];
                                  return InkWell(
                                    onTap: () {
                                      Navigator.pop(context);
                                      if (element == selectedValue) {
                                        return;
                                      }
                                      packageNotifier.value = element;
                                      if (onChanged == null) {
                                        return;
                                      }
                                      onChanged(element);
                                    },
                                    child: ListTile(
                                      title: Text(
                                        element?.title ?? '',
                                        style: context.titleSmall?.bold6,
                                      ),
                                      subtitle: Text(
                                          "${LocalKeys.duration}: ${element?.duration ?? ""}"),
                                      trailing: RichText(
                                        text: TextSpan(
                                          text: null,
                                          style: context.titleSmall?.bold6,
                                          children: [
                                            TextSpan(
                                                text: (element?.budget ?? 0)
                                                    .toStringAsFixed(2)
                                                    .cur,
                                                style: context.titleSmall?.bold6
                                                    .copyWith(
                                                        color: primaryColor)),
                                          ],
                                        ),
                                      ),
                                    ),
                                  );
                                },
                                separatorBuilder: (context, index) =>
                                    const SizedBox(
                                      height: 8,
                                      child: Center(child: Divider()),
                                    ),
                                itemCount: cProvider.packagesLoading == true ||
                                        cProvider.packagesDropdownList.isEmpty
                                    ? 1
                                    : cProvider.packagesDropdownList.length +
                                        (cProvider.nextPage != null &&
                                                !cProvider.nexLoadingFailed
                                            ? 1
                                            : 0)),
                          )
                        ],
                      );
                    }),
                  );
                },
              );
            },
            child: Container(
              height: 50,
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(8),
                border: Border.all(color: context.dProvider.black7, width: 1),
              ),
              child: Row(
                children: [
                  8.toWidth,
                  Expanded(
                    flex: 1,
                    child: RichText(
                      text: TextSpan(
                          text: selectedValue?.title ?? LocalKeys.choseAPackage,
                          style: context.titleSmall?.copyWith(
                              color: context.dProvider.black6,
                              fontWeight: FontWeight.w600),
                          children: [
                            if (selectedValue != null)
                              TextSpan(
                                  text:
                                      " ( ${(selectedValue.budget).toStringAsFixed(2).cur} )",
                                  style: context.titleSmall?.bold6
                                      .copyWith(color: primaryColor)),
                          ]),
                      maxLines: 1,
                      overflow: TextOverflow.ellipsis,
                    ),
                  ),
                  Padding(
                    padding: const EdgeInsets.symmetric(horizontal: 12),
                    child: SvgAssets.arrowDown.toSVGSized(24.0),
                  ),
                ],
              ),
            ),
          ),
          EmptySpaceHelper.emptyHeight(12),
        ],
      ),
    );
  }

  tryLoadingMore(BuildContext context) async {
    try {
      final cd = Provider.of<PromotionPackagesService>(context, listen: false);
      final nextPage = cd.nextPage;
      final nextPageLoading = cd.nextPageLoading;

      if (controller.offset == controller.position.maxScrollExtent &&
          !controller.position.outOfRange) {
        if (nextPage != null && !nextPageLoading) {
          cd.fetchNextPage();
          return;
        }
      }
    } catch (e) {}
  }
}

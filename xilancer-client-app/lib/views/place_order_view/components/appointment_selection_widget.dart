import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/view_models/place_order_view_model/place_order_view_model.dart';

import '../../../utils/components/custom_date_picker_sheet.dart';
import '../../../utils/components/custom_time_picker_sheet.dart';

class AppointmentSelectionWidget extends StatelessWidget {
  const AppointmentSelectionWidget({super.key});

  @override
  Widget build(BuildContext context) {
    final pom = PlaceOrderViewViewModel.instance;
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        16.toHeight,
        Text(LocalKeys.appointmentDate, style: context.titleMedium?.bold6),
        12.toHeight,
        Row(
          children: [
            Expanded(
              child: ValueListenableBuilder<DateTime?>(
                valueListenable: pom.appointmentDate,
                builder: (context, date, child) {
                  return InkWell(
                    onTap: () async {
                      final selected = await CustomDatePickerSheet.show(
                        context,
                        initialDate: date ?? DateTime.now().add(const Duration(days: 1)),
                        firstDate: DateTime.now(),
                        lastDate: DateTime.now().add(const Duration(days: 90)),
                      );
                      if (selected != null) {
                        pom.appointmentDate.value = selected;
                      }
                    },
                    child: Container(
                      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
                      decoration: BoxDecoration(
                        color: context.dProvider.black9,
                        border: Border.all(color: context.dProvider.black8),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Row(
                        children: [
                          Icon(Icons.calendar_today_rounded, size: 18, color: context.dProvider.primaryColor),
                          10.toWidth,
                          Expanded(
                            child: Text(
                              date == null ? "Tarih Seç" : DateFormat('dd/MM/yyyy').format(date),
                              style: context.bodyMedium?.copyWith(
                                color: date == null ? context.dProvider.black7 : context.dProvider.black3,
                                fontWeight: date == null ? FontWeight.normal : FontWeight.bold,
                              ),
                              overflow: TextOverflow.ellipsis,
                              maxLines: 1,
                            ),
                          ),
                        ],
                      ),
                    ),
                  );
                },
              ),
            ),
            12.toWidth,
            Expanded(
              child: ValueListenableBuilder<TimeOfDay?>(
                valueListenable: pom.appointmentTime,
                builder: (context, time, child) {
                  return InkWell(
                    onTap: () async {
                      final selected = await CustomTimePickerSheet.show(
                        context,
                        initialTime: time ?? TimeOfDay.now(),
                      );
                      if (selected != null) {
                        pom.appointmentTime.value = selected;
                      }
                    },
                    child: Container(
                      padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
                      decoration: BoxDecoration(
                        color: context.dProvider.black9,
                        border: Border.all(color: context.dProvider.black8),
                        borderRadius: BorderRadius.circular(12),
                      ),
                      child: Row(
                        children: [
                          Icon(Icons.access_time_rounded, size: 18, color: context.dProvider.primaryColor),
                          10.toWidth,
                          Expanded(
                            child: Text(
                              time == null ? "Saat Seç" : time.format(context),
                              style: context.bodyMedium?.copyWith(
                                color: time == null ? context.dProvider.black7 : context.dProvider.black3,
                                fontWeight: time == null ? FontWeight.normal : FontWeight.bold,
                              ),
                              overflow: TextOverflow.ellipsis,
                              maxLines: 1,
                            ),
                          ),
                        ],
                      ),
                    ),
                  );
                },
              ),
            ),
          ],
        ),
      ],
    );
  }
}

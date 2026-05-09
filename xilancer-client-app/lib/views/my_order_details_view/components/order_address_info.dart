import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';

class OrderAddressInfo extends StatelessWidget {
  final String? address;
  final String? city;
  final String? state;
  final String? country;
  final DateTime? appointmentDate;
  final String? appointmentTime;

  const OrderAddressInfo({
    super.key,
    this.address,
    this.city,
    this.state,
    this.country,
    this.appointmentDate,
    this.appointmentTime,
  });

  @override
  Widget build(BuildContext context) {
    if ((address == null || address!.isEmpty) && appointmentDate == null) {
      return const SizedBox.shrink();
    }
    return Container(
      margin: const EdgeInsets.only(top: 20),
      padding: const EdgeInsets.all(20),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: BorderRadius.circular(8),
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          if (address != null && address!.isNotEmpty) ...[
            Text(
              LocalKeys.addressDetails,
              style: context.titleMedium?.bold6,
            ),
            12.toHeight,
            _infoRow(context, Icons.location_on, address!),
            if (city != null || state != null || country != null)
              Padding(
                padding: const EdgeInsets.only(left: 28, top: 4),
                child: Text(
                  "${city ?? ""} ${state ?? ""} ${country ?? ""}".trim(),
                  style: context.titleSmall?.copyWith(color: context.dProvider.black5),
                ),
              ),
            if (appointmentDate != null) 16.toHeight,
          ],
          if (appointmentDate != null) ...[
            Text(
              LocalKeys.appointmentDate,
              style: context.titleMedium?.bold6,
            ),
            12.toHeight,
            _infoRow(
              context,
              Icons.calendar_today,
              DateFormat("dd MMMM yyyy").format(appointmentDate!),
            ),
            if (appointmentTime != null && appointmentTime!.isNotEmpty)
              Padding(
                padding: const EdgeInsets.only(left: 28, top: 4),
                child: Text(
                  "${LocalKeys.appointmentTime}: $appointmentTime",
                  style: context.titleSmall?.copyWith(color: context.dProvider.black5),
                ),
              ),
          ],
        ],
      ),
    );
  }

  Widget _infoRow(BuildContext context, IconData icon, String text) {
    return Row(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Icon(icon, size: 20, color: context.dProvider.primaryColor),
        8.toWidth,
        Expanded(
          child: Text(
            text,
            style: context.titleSmall,
          ),
        ),
      ],
    );
  }
}

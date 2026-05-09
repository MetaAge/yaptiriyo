import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/models/project_details_model.dart';
import 'package:xilancer/models/state_model.dart';
import 'package:xilancer/models/city_dropdown_model.dart';

class ProjectDetailsServiceAreas extends StatelessWidget {
  final List<ServiceArea>? serviceAreas;

  const ProjectDetailsServiceAreas({super.key, this.serviceAreas});

  @override
  Widget build(BuildContext context) {
    final bool isAllRegions = serviceAreas == null || serviceAreas!.isEmpty;

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Row(
          children: [
            Icon(Icons.location_on_rounded,
                size: 14, color: context.dProvider.black5),
            6.toWidth,
            Text(
              "Hizmet Bölgeleri:",
              style: context.bodySmall?.copyWith(
                color: context.dProvider.black5,
                fontWeight: FontWeight.w600,
                fontSize: 12,
              ),
            ),
          ],
        ),
        8.toHeight,
        if (isAllRegions)
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
            decoration: BoxDecoration(
              color: context.dProvider.black9,
              borderRadius: BorderRadius.circular(10),
              border: Border.all(color: context.dProvider.black8),
            ),
            child: Text(
              "Tüm Bölgeler",
              style: context.bodySmall?.copyWith(
                fontSize: 11,
                fontWeight: FontWeight.w500,
                color: context.dProvider.black3,
              ),
            ),
          )
        else
          Wrap(
            spacing: 8,
            runSpacing: 8,
            children: serviceAreas!.map((area) {
              String label = "";
              final stateName = area.state?.name ?? "";
              final cityName = area.city?.name ?? "";
              if (stateName.isNotEmpty) label = stateName;
              if (cityName.isNotEmpty)
                label = label.isEmpty ? cityName : "$label - $cityName";
              if (label.isEmpty) label = "Bölge Belirtilmedi";

              return Container(
                padding:
                    const EdgeInsets.symmetric(horizontal: 12, vertical: 6),
                decoration: BoxDecoration(
                  color: context.dProvider.black9,
                  borderRadius: BorderRadius.circular(10),
                  border: Border.all(color: context.dProvider.black8),
                ),
                child: Text(
                  label,
                  style: context.bodySmall?.copyWith(
                    fontSize: 11,
                    fontWeight: FontWeight.w500,
                    color: context.dProvider.black3,
                  ),
                ),
              );
            }).toList(),
          ),
      ],
    );
  }
}

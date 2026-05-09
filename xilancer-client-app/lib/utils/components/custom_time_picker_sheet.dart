import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';

class CustomTimePickerSheet extends StatefulWidget {
  final TimeOfDay initialTime;

  const CustomTimePickerSheet({
    super.key,
    required this.initialTime,
  });

  static Future<TimeOfDay?> show(BuildContext context, {
    required TimeOfDay initialTime,
  }) {
    return showModalBottomSheet<TimeOfDay>(
      context: context,
      backgroundColor: Colors.transparent,
      isScrollControlled: true,
      builder: (context) => CustomTimePickerSheet(
        initialTime: initialTime,
      ),
    );
  }

  @override
  State<CustomTimePickerSheet> createState() => _CustomTimePickerSheetState();
}

class _CustomTimePickerSheetState extends State<CustomTimePickerSheet> {
  late int _selectedHour;
  late int _selectedMinute;

  @override
  void initState() {
    super.initState();
    _selectedHour = widget.initialTime.hour;
    _selectedMinute = widget.initialTime.minute;
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(vertical: 24),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: const BorderRadius.vertical(top: Radius.circular(32)),
      ),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          // Handle
          Container(
            width: 40,
            height: 4,
            decoration: BoxDecoration(
              color: context.dProvider.black8,
              borderRadius: BorderRadius.circular(2),
            ),
          ),
          24.toHeight,
          
          Text(
            "Saat Seçin",
            style: context.titleMedium?.bold6,
          ),
          
          24.toHeight,
          
          SizedBox(
            height: 200,
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                // Hours
                _wheelPicker(
                  itemCount: 24,
                  initialIndex: _selectedHour,
                  onChanged: (index) => setState(() => _selectedHour = index),
                  label: (index) => index.toString().padLeft(2, '0'),
                ),
                
                Text(":", style: context.titleLarge?.bold6),
                
                // Minutes
                _wheelPicker(
                  itemCount: 60,
                  initialIndex: _selectedMinute,
                  onChanged: (index) => setState(() => _selectedMinute = index),
                  label: (index) => index.toString().padLeft(2, '0'),
                ),
              ],
            ),
          ),
          
          32.toHeight,
          
          // Confirm Button
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 24),
            child: SizedBox(
              width: double.infinity,
              height: 50,
              child: ElevatedButton(
                onPressed: () => Navigator.pop(context, TimeOfDay(hour: _selectedHour, minute: _selectedMinute)),
                style: ElevatedButton.styleFrom(
                  backgroundColor: context.dProvider.primaryColor,
                  foregroundColor: Colors.white,
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                  elevation: 0,
                ),
                child: const Text("Saati Onayla", style: TextStyle(fontWeight: FontWeight.bold)),
              ),
            ),
          ),
          SizedBox(height: MediaQuery.of(context).padding.bottom + 12),
        ],
      ),
    );
  }

  Widget _wheelPicker({
    required int itemCount,
    required int initialIndex,
    required ValueChanged<int> onChanged,
    required String Function(int) label,
  }) {
    return SizedBox(
      width: 80,
      child: ListWheelScrollView.useDelegate(
        itemExtent: 50,
        perspective: 0.005,
        diameterRatio: 1.2,
        physics: const FixedExtentScrollPhysics(),
        controller: FixedExtentScrollController(initialItem: initialIndex),
        onSelectedItemChanged: onChanged,
        childDelegate: ListWheelChildBuilderDelegate(
          builder: (context, index) {
            if (index < 0 || index >= itemCount) return null;
            final isSelected = index == (itemCount == 24 ? _selectedHour : _selectedMinute);
            return Center(
              child: Text(
                label(index),
                style: context.titleLarge?.copyWith(
                  color: isSelected ? context.dProvider.primaryColor : context.dProvider.black7,
                  fontWeight: isSelected ? FontWeight.bold : FontWeight.normal,
                ),
              ),
            );
          },
          childCount: itemCount,
        ),
      ),
    );
  }
}

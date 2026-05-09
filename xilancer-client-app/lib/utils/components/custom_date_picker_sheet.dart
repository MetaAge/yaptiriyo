import 'package:flutter/material.dart';
import 'package:intl/intl.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';

class CustomDatePickerSheet extends StatefulWidget {
  final DateTime initialDate;
  final DateTime firstDate;
  final DateTime lastDate;

  const CustomDatePickerSheet({
    super.key,
    required this.initialDate,
    required this.firstDate,
    required this.lastDate,
  });

  static Future<DateTime?> show(BuildContext context, {
    required DateTime initialDate,
    required DateTime firstDate,
    required DateTime lastDate,
  }) {
    return showModalBottomSheet<DateTime>(
      context: context,
      backgroundColor: Colors.transparent,
      isScrollControlled: true,
      builder: (context) => CustomDatePickerSheet(
        initialDate: initialDate,
        firstDate: firstDate,
        lastDate: lastDate,
      ),
    );
  }

  @override
  State<CustomDatePickerSheet> createState() => _CustomDatePickerSheetState();
}

class _CustomDatePickerSheetState extends State<CustomDatePickerSheet> {
  late DateTime _focusedDate;
  late DateTime _selectedDate;

  @override
  void initState() {
    super.initState();
    _focusedDate = widget.initialDate;
    _selectedDate = widget.initialDate;
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
          
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 24),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.spaceBetween,
              children: [
                Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      "${_monthName(_focusedDate.month)} ${_focusedDate.year}",
                      style: context.titleMedium?.bold6,
                    ),
                    Text(
                      "Seçilen: ${DateFormat('dd/MM/yyyy').format(_selectedDate)}",
                      style: context.bodySmall?.copyWith(color: context.dProvider.primaryColor),
                    ),
                  ],
                ),
                Row(
                  children: [
                    _navButton(Icons.chevron_left, () {
                      setState(() {
                        _focusedDate = DateTime(_focusedDate.year, _focusedDate.month - 1);
                      });
                    }),
                    12.toWidth,
                    _navButton(Icons.chevron_right, () {
                      setState(() {
                        _focusedDate = DateTime(_focusedDate.year, _focusedDate.month + 1);
                      });
                    }),
                  ],
                ),
              ],
            ),
          ),
          
          24.toHeight,
          
          // Calendar Grid
          Padding(
            padding: const EdgeInsets.symmetric(horizontal: 16),
            child: Column(
              children: [
                // Weekdays
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceAround,
                  children: ['Pt', 'Sa', 'Çr', 'Pr', 'Cu', 'Ct', 'Pz'].map((d) => SizedBox(
                    width: 40,
                    child: Center(
                      child: Text(
                        d,
                        style: context.bodySmall?.copyWith(
                          color: context.dProvider.black7,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                    ),
                  )).toList(),
                ),
                12.toHeight,
                _buildCalendarGrid(),
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
                onPressed: () => Navigator.pop(context, _selectedDate),
                style: ElevatedButton.styleFrom(
                  backgroundColor: context.dProvider.primaryColor,
                  foregroundColor: Colors.white,
                  shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(16)),
                  elevation: 0,
                ),
                child: const Text("Tarihi Onayla", style: TextStyle(fontWeight: FontWeight.bold)),
              ),
            ),
          ),
          SizedBox(height: MediaQuery.of(context).padding.bottom + 12),
        ],
      ),
    );
  }

  Widget _navButton(IconData icon, VoidCallback onTap) {
    return InkWell(
      onTap: onTap,
      borderRadius: BorderRadius.circular(10),
      child: Container(
        padding: const EdgeInsets.all(8),
        decoration: BoxDecoration(
          border: Border.all(color: context.dProvider.black8),
          borderRadius: BorderRadius.circular(10),
        ),
        child: Icon(icon, size: 20, color: context.dProvider.black3),
      ),
    );
  }

  Widget _buildCalendarGrid() {
    final firstDayOfMonth = DateTime(_focusedDate.year, _focusedDate.month, 1);
    final lastDayOfMonth = DateTime(_focusedDate.year, _focusedDate.month + 1, 0);
    
    // Adjust for Monday start (Pt = 1, Pz = 7)
    int firstWeekday = firstDayOfMonth.weekday;
    int prevMonthDays = firstWeekday - 1;
    
    List<Widget> dayWidgets = [];
    
    return GridView.builder(
      shrinkWrap: true,
      physics: const NeverScrollableScrollPhysics(),
      padding: EdgeInsets.zero,
      gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
        crossAxisCount: 7,
        mainAxisSpacing: 4,
        crossAxisSpacing: 4,
      ),
      itemCount: prevMonthDays + lastDayOfMonth.day,
      itemBuilder: (context, index) {
        if (index < prevMonthDays) return const SizedBox.shrink();
        
        final day = index - prevMonthDays + 1;
        final date = DateTime(_focusedDate.year, _focusedDate.month, day);
        final isSelected = _selectedDate.year == date.year && 
                          _selectedDate.month == date.month && 
                          _selectedDate.day == date.day;
        final isToday = DateTime.now().year == date.year && 
                        DateTime.now().month == date.month && 
                        DateTime.now().day == date.day;
        final isDisabled = date.isBefore(DateTime(widget.firstDate.year, widget.firstDate.month, widget.firstDate.day)) || 
                          date.isAfter(widget.lastDate);

        return GestureDetector(
          onTap: isDisabled ? null : () {
            setState(() {
              _selectedDate = date;
            });
          },
          child: Container(
            decoration: BoxDecoration(
              color: isSelected ? context.dProvider.primaryColor : Colors.transparent,
              shape: BoxShape.circle,
              border: isToday && !isSelected ? Border.all(color: context.dProvider.primaryColor) : null,
            ),
            child: Center(
              child: Text(
                day.toString(),
                style: context.bodyMedium?.copyWith(
                  color: isSelected 
                    ? Colors.white 
                    : isDisabled 
                      ? context.dProvider.black8 
                      : context.dProvider.black3,
                  fontWeight: isSelected || isToday ? FontWeight.bold : FontWeight.normal,
                ),
              ),
            ),
          ),
        );
      },
    );
  }

  String _monthName(int month) {
    const months = [
      "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran",
      "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"
    ];
    return months[month - 1];
  }
}

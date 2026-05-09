import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';
import 'package:xilancer/customizations.dart';

class MaintenanceView extends StatelessWidget {
  final String message;
  const MaintenanceView({super.key, required this.message});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        padding: const EdgeInsets.all(24),
        width: double.infinity,
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Lottie.asset('assets/animations/maintenance.json', height: 200, errorBuilder: (context, error, stackTrace) {
              return const Icon(Icons.build_circle_outlined, size: 100, color: Colors.orange);
            }),
            const SizedBox(height: 32),
            Text(
              "Bakım Modu",
              style: Theme.of(context).textTheme.headlineMedium?.copyWith(fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 16),
            Text(
              message,
              textAlign: TextAlign.center,
              style: const TextStyle(color: Colors.grey, fontSize: 16),
            ),
            const SizedBox(height: 48),
            const CircularProgressIndicator(),
            const SizedBox(height: 16),
            const Text("Sistem hazır olduğunda otomatik olarak açılacaktır.", 
              style: TextStyle(fontSize: 12, color: Colors.grey)),
          ],
        ),
      ),
    );
  }
}

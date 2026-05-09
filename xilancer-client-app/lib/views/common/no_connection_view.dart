import 'package:flutter/material.dart';
import 'package:lottie/lottie.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/view_models/splash_view/splash_view_model.dart';

class NoConnectionView extends StatefulWidget {
  const NoConnectionView({super.key});

  @override
  State<NoConnectionView> createState() => _NoConnectionViewState();
}

class _NoConnectionViewState extends State<NoConnectionView> {
  bool isLoading = false;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        padding: const EdgeInsets.all(24),
        width: double.infinity,
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Lottie.asset(
              'assets/animations/no_internet.json',
              height: 200,
              errorBuilder: (context, error, stackTrace) {
                return const Icon(
                  Icons.wifi_off,
                  size: 100,
                  color: Colors.grey,
                );
              },
            ),
            const SizedBox(height: 32),
            Text(
              "Bağlantı Yok",
              style: Theme.of(
                context,
              ).textTheme.headlineMedium?.copyWith(fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 16),
            const Text(
              "Lütfen internet bağlantınızı kontrol edin ve tekrar deneyin.",
              textAlign: TextAlign.center,
              style: TextStyle(color: Colors.grey, fontSize: 16),
            ),
            const SizedBox(height: 48),
            SizedBox(
              width: double.infinity,
              height: 50,
              child: ElevatedButton(
                onPressed:
                    isLoading
                        ? null
                        : () async {
                          setState(() => isLoading = true);
                          // Bağlantıyı tekrar kontrol et ve akışı başlat
                          await SplashViewModel().initiateStartingSequence(
                            context,
                          );
                          if (mounted) {
                            setState(() => isLoading = false);
                          }
                        },
                style: ElevatedButton.styleFrom(
                  backgroundColor: primaryColor,
                  shape: RoundedRectangleBorder(
                    borderRadius: BorderRadius.circular(12),
                  ),
                ),
                child:
                    isLoading
                        ? const SizedBox(
                          height: 20,
                          width: 20,
                          child: CircularProgressIndicator(
                            color: Colors.white,
                            strokeWidth: 2,
                          ),
                        )
                        : const Text(
                          "Tekrar Dene",
                          style: TextStyle(color: Colors.white, fontSize: 16),
                        ),
              ),
            ),
          ],
        ),
      ),
    );
  }
}

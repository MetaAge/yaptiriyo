import 'package:flutter/material.dart';
import 'package:url_launcher/url_launcher.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/models/profile_details_model.dart';
import 'package:xilancer/utils/components/custom_preloader.dart';

class ProfileContactButtons extends StatelessWidget {
  final User? user;
  final bool isPro;
  final bool isPremium;

  const ProfileContactButtons({
    super.key,
    required this.user,
    required this.isPro,
    required this.isPremium,
  });

  @override
  Widget build(BuildContext context) {
    if (user?.phone == null || user!.phone!.isEmpty) return const SizedBox();
    if (!isPro && !isPremium) return const SizedBox();

    return Column(
      children: [
        const Divider(height: 48, thickness: 1.5, color: Colors.black12),
        Row(
          children: [
            if (isPro || isPremium)
              Expanded(
                child: _buildContactButton(
                  context: context,
                  onTap: () => _launchCaller(user!.phone!),
                  icon: Icons.phone_in_talk_rounded,
                  label: "Hemen Ara",
                  gradient: [const Color(0xFF3B82F6), const Color(0xFF2563EB)],
                ),
              ),
            if (isPremium) ...[
              const SizedBox(width: 16),
              Expanded(
                child: _buildContactButton(
                  context: context,
                  onTap: () => _launchWhatsApp(user!.phone!),
                  icon: Icons.chat_bubble_rounded,
                  label: "WhatsApp",
                  gradient: [const Color(0xFF22C55E), const Color(0xFF16A34A)],
                ),
              ),
            ],
          ],
        ),
      ],
    );
  }

  Widget _buildContactButton({
    required BuildContext context,
    required VoidCallback onTap,
    required IconData icon,
    required String label,
    required List<Color> gradient,
  }) {
    return Container(
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(16),
        gradient: LinearGradient(
          colors: gradient,
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        boxShadow: [
          BoxShadow(
            color: gradient[1].withOpacity(0.3),
            blurRadius: 12,
            offset: const Offset(0, 6),
          ),
        ],
      ),
      child: Material(
        color: Colors.transparent,
        child: InkWell(
          onTap: onTap,
          borderRadius: BorderRadius.circular(16),
          child: Padding(
            padding: const EdgeInsets.symmetric(vertical: 14),
            child: Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Icon(icon, color: Colors.white, size: 20),
                const SizedBox(width: 8),
                Text(
                  label,
                  style: const TextStyle(
                    color: Colors.white,
                    fontWeight: FontWeight.bold,
                    fontSize: 15,
                    letterSpacing: 0.5,
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  void _launchCaller(String phone) async {
    String cleanPhone = phone.replaceAll(RegExp(r'[^\d+]'), '');
    final Uri url = Uri.parse('tel:$cleanPhone');
    if (await canLaunchUrl(url)) {
      await launchUrl(url);
    }
  }

  void _launchWhatsApp(String phone) async {
    // Basic phone cleaning
    String cleanPhone = phone.replaceAll(RegExp(r'[^\d]'), '');
    // If it starts with 0, remove it
    if (cleanPhone.startsWith('0')) {
      cleanPhone = cleanPhone.substring(1);
    }
    // If it doesn't have 90, add it (Turkish numbers)
    if (cleanPhone.length == 10) {
      cleanPhone = '90$cleanPhone';
    }
    final Uri url = Uri.parse('https://wa.me/$cleanPhone');
    if (await canLaunchUrl(url)) {
      await launchUrl(url, mode: LaunchMode.externalApplication);
    }
  }
}


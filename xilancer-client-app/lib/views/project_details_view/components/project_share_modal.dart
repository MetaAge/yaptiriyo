import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/utils/components/success_overlay.dart';

class ProjectShareModal extends StatelessWidget {
  final String title;
  final String imageUrl;
  final String price;
  final String link;

  const ProjectShareModal({
    super.key,
    required this.title,
    required this.imageUrl,
    required this.price,
    required this.link,
  });

  static void show(BuildContext context, {
    required String title,
    required String imageUrl,
    required String price,
    required String link,
  }) {
    showModalBottomSheet(
      context: context,
      backgroundColor: Colors.transparent,
      isScrollControlled: true,
      builder: (context) => ProjectShareModal(
        title: title,
        imageUrl: imageUrl,
        price: price,
        link: link,
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 12),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: const BorderRadius.vertical(top: Radius.circular(32)),
      ),
      child: Column(
        mainAxisSize: MainAxisSize.min,
        children: [
          Container(
            width: 40,
            height: 4,
            decoration: BoxDecoration(
              color: context.dProvider.black8,
              borderRadius: BorderRadius.circular(2),
            ),
          ),
          const SizedBox(height: 24),
          Text(
            "Hizmeti Paylaş",
            style: context.titleLarge?.copyWith(
              fontWeight: FontWeight.bold,
              color: context.dProvider.black2,
            ),
          ),
          const SizedBox(height: 8),
          Text(
            "Bu harika hizmeti arkadaşlarınla paylaş",
            style: context.bodySmall?.copyWith(color: context.dProvider.black5),
          ),
          const SizedBox(height: 24),
          // Share Card Preview
          Container(
            padding: const EdgeInsets.all(20),
            decoration: BoxDecoration(
              gradient: LinearGradient(
                colors: [
                  context.dProvider.primaryColor,
                  context.dProvider.primaryColor.withOpacity(0.8),
                ],
                begin: Alignment.topLeft,
                end: Alignment.bottomRight,
              ),
              borderRadius: BorderRadius.circular(28),
              boxShadow: [
                BoxShadow(
                  color: context.dProvider.primaryColor.withOpacity(0.3),
                  blurRadius: 20,
                  offset: const Offset(0, 10),
                ),
              ],
            ),
            child: Row(
              children: [
                Container(
                  decoration: BoxDecoration(
                    borderRadius: BorderRadius.circular(16),
                    boxShadow: [
                      BoxShadow(color: Colors.black.withOpacity(0.1), blurRadius: 10)
                    ],
                  ),
                  child: ClipRRect(
                    borderRadius: BorderRadius.circular(16),
                    child: Image.network(
                      imageUrl,
                      width: 90,
                      height: 90,
                      fit: BoxFit.cover,
                      errorBuilder: (context, error, stackTrace) => Container(
                        width: 90,
                        height: 90,
                        color: Colors.white24,
                        child: const Icon(Icons.image, color: Colors.white),
                      ),
                    ),
                  ),
                ),
                const SizedBox(width: 20),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    children: [
                      Text(
                        title,
                        maxLines: 2,
                        overflow: TextOverflow.ellipsis,
                        style: context.titleSmall?.copyWith(
                          fontWeight: FontWeight.bold,
                          color: Colors.white,
                          height: 1.3,
                        ),
                      ),
                      const SizedBox(height: 10),
                      Container(
                        padding: const EdgeInsets.symmetric(horizontal: 10, vertical: 4),
                        decoration: BoxDecoration(
                          color: Colors.white.withOpacity(0.2),
                          borderRadius: BorderRadius.circular(8),
                        ),
                        child: Text(
                          price,
                          style: const TextStyle(
                            color: Colors.white,
                            fontWeight: FontWeight.bold,
                            fontSize: 12,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
          const SizedBox(height: 32),
          // Actions
          Row(
            children: [
              Expanded(
                child: _ShareAction(
                  icon: Icons.copy_rounded,
                  label: "Linki Kopyala",
                  onTap: () {
                    Clipboard.setData(ClipboardData(text: link));
                    Navigator.pop(context);
                    SuccessOverlay.show(context, "Link Kopyalandı");
                  },
                ),
              ),
              const SizedBox(width: 16),
              Expanded(
                child: _ShareAction(
                  icon: Icons.qr_code_rounded,
                  label: "QR Kod",
                  onTap: () {
                    Navigator.pop(context);
                    SuccessOverlay.show(context, "QR Kod Oluşturuldu");
                  },
                ),
              ),
            ],
          ),
          const SizedBox(height: 24),
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceEvenly,
            children: [
              _SocialIcon(icon: Icons.facebook, color: const Color(0xFF1877F2)),
              _SocialIcon(icon: Icons.camera_alt, color: const Color(0xFFE4405F)),
              _SocialIcon(icon: Icons.send_rounded, color: const Color(0xFF25D366)),
              _SocialIcon(icon: Icons.message_rounded, color: context.dProvider.primaryColor),
            ],
          ),
          const SizedBox(height: 32),
        ],
      ),
    );
  }
}

class _ShareAction extends StatelessWidget {
  final IconData icon;
  final String label;
  final VoidCallback onTap;

  const _ShareAction({required this.icon, required this.label, required this.onTap});

  @override
  Widget build(BuildContext context) {
    return GestureDetector(
      onTap: onTap,
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 20),
        decoration: BoxDecoration(
          color: context.dProvider.black9,
          borderRadius: BorderRadius.circular(20),
          border: Border.all(color: context.dProvider.black8),
        ),
        child: Column(
          children: [
            Icon(icon, color: context.dProvider.black2, size: 28),
            const SizedBox(height: 10),
            Text(
              label,
              style: context.bodySmall?.copyWith(
                fontWeight: FontWeight.bold,
                color: context.dProvider.black3,
              ),
            ),
          ],
        ),
      ),
    );
  }
}

class _SocialIcon extends StatelessWidget {
  final IconData icon;
  final Color color;

  const _SocialIcon({required this.icon, required this.color});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(14),
      decoration: BoxDecoration(
        color: color.withOpacity(0.1),
        shape: BoxShape.circle,
        border: Border.all(color: color.withOpacity(0.2), width: 1.5),
      ),
      child: Icon(icon, color: color, size: 28),
    );
  }
}

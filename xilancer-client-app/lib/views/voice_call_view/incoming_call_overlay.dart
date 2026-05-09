import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/main.dart';
import 'package:xilancer/services/agora_call_service.dart';
import 'package:xilancer/views/voice_call_view/voice_call_view.dart';
import 'package:cached_network_image/cached_network_image.dart';

class IncomingCallOverlay extends StatelessWidget {
  final int callId;
  final String channelName;
  final String appId;
  final String callerName;
  final String? callerImage;

  const IncomingCallOverlay({
    super.key,
    required this.callId,
    required this.channelName,
    required this.appId,
    required this.callerName,
    this.callerImage,
  });

  static void show(
    BuildContext context, {
    required int callId,
    required String channelName,
    required String appId,
    required String callerName,
    String? callerImage,
  }) {
    showDialog(
      context: context,
      barrierDismissible: false,
      barrierColor: Colors.black87,
      builder: (ctx) {
        return IncomingCallOverlay(
          callId: callId,
          channelName: channelName,
          appId: appId,
          callerName: callerName,
          callerImage: callerImage,
        );
      },
    ).then((_) {
      // Clear ringing state when dismissed for any reason (if not already cleared)
      final context = navigatorKey.currentContext;
      if (context != null) {
        final callService = Provider.of<AgoraCallService>(context, listen: false);
        if (callService.isRinging) {
          callService.setRinging(false);
        }
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return PopScope(
      canPop: false,
      child: Dialog(
        backgroundColor: Colors.transparent,
        insetPadding: const EdgeInsets.all(20),
        child: Container(
          padding: const EdgeInsets.symmetric(horizontal: 30, vertical: 40),
          decoration: BoxDecoration(
            gradient: LinearGradient(
              colors: [
                const Color(0xFF1a1a2e),
                primaryColor.withOpacity(0.3),
              ],
              begin: Alignment.topCenter,
              end: Alignment.bottomCenter,
            ),
            borderRadius: BorderRadius.circular(24),
          ),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              const Text(
                'Gelen Arama',
                style: TextStyle(
                  color: Colors.white70,
                  fontSize: 16,
                ),
              ),
              const SizedBox(height: 24),
              // Avatar
              Container(
                width: 100,
                height: 100,
                decoration: BoxDecoration(
                  shape: BoxShape.circle,
                  gradient: LinearGradient(
                    colors: [primaryColor, softBlue],
                  ),
                  boxShadow: [
                    BoxShadow(
                      color: primaryColor.withOpacity(0.4),
                      blurRadius: 20,
                      spreadRadius: 2,
                    ),
                  ],
                ),
                child: ClipOval(
                  child: callerImage != null && callerImage!.isNotEmpty
                      ? CachedNetworkImage(
                          imageUrl: callerImage!,
                          fit: BoxFit.cover,
                          placeholder: (_, __) => _buildInitials(),
                          errorWidget: (_, __, ___) => _buildInitials(),
                        )
                      : _buildInitials(),
                ),
              ),
              const SizedBox(height: 16),
              Text(
                callerName,
                style: const TextStyle(
                  color: Colors.white,
                  fontSize: 24,
                  fontWeight: FontWeight.w600,
                ),
              ),
              const SizedBox(height: 8),
              const Text(
                'Sesli Arama',
                style: TextStyle(color: Colors.white54, fontSize: 14),
              ),
              const SizedBox(height: 40),
              // Accept / Decline buttons
              Row(
                mainAxisAlignment: MainAxisAlignment.spaceEvenly,
                children: [
                  // Decline
                  _buildActionButton(
                    icon: Icons.call_end,
                    color: Colors.red,
                    label: 'Reddet',
                    onTap: () async {
                      final callService = Provider.of<AgoraCallService>(
                          context,
                          listen: false);
                      callService.setRinging(false);
                      await callService.declineCall(callId);
                      navigatorKey.currentState?.pop();
                    },
                  ),
                  // Accept
                  _buildActionButton(
                    icon: Icons.call,
                    color: Colors.green,
                    label: 'Kabul Et',
                    onTap: () async {
                      final callService = Provider.of<AgoraCallService>(
                          context,
                          listen: false);
                      callService.setRinging(false);
                      final success = await callService.acceptCall(
                          callId, channelName, appId);
                      
                      navigatorKey.currentState?.pop(); // Close overlay

                      if (success) {
                        navigatorKey.currentState?.push(MaterialPageRoute(
                          builder: (_) => VoiceCallView(
                            callerName: callerName,
                            callerImage: callerImage,
                            isOutgoing: false,
                          ),
                        ));
                      }
                    },
                  ),
                ],
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildInitials() {
    return Center(
      child: Text(
        callerName.isNotEmpty ? callerName[0].toUpperCase() : '?',
        style: const TextStyle(
          color: Colors.white,
          fontSize: 40,
          fontWeight: FontWeight.bold,
        ),
      ),
    );
  }

  Widget _buildActionButton({
    required IconData icon,
    required Color color,
    required String label,
    required VoidCallback onTap,
  }) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        GestureDetector(
          onTap: onTap,
          child: Container(
            width: 64,
            height: 64,
            decoration: BoxDecoration(
              color: color,
              shape: BoxShape.circle,
              boxShadow: [
                BoxShadow(
                  color: color.withOpacity(0.4),
                  blurRadius: 12,
                  spreadRadius: 2,
                ),
              ],
            ),
            child: Icon(icon, color: Colors.white, size: 30),
          ),
        ),
        const SizedBox(height: 8),
        Text(
          label,
          style: const TextStyle(color: Colors.white70, fontSize: 13),
        ),
      ],
    );
  }
}

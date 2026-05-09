import 'dart:ui';
import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/services/agora_call_service.dart';
import 'package:cached_network_image/cached_network_image.dart';
import 'package:xilancer/main.dart';

class VoiceCallView extends StatefulWidget {
  static const routeName = "voice_call_view";

  final String callerName;
  final String? callerImage;
  final bool isOutgoing;

  const VoiceCallView({
    super.key,
    required this.callerName,
    this.callerImage,
    this.isOutgoing = true,
  });

  @override
  State<VoiceCallView> createState() => _VoiceCallViewState();
}

class _VoiceCallViewState extends State<VoiceCallView> {
  bool _wasConnected = false;

  @override
  void initState() {
    super.initState();
    // Add listener to auto-dismiss when call ends
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final callService = Provider.of<AgoraCallService>(context, listen: false);
      callService.addListener(_handleCallStateChange);
    });
  }

  @override
  void dispose() {
    // We need to be careful with dispose if the service is a singleton
    // and we don't want to keep the listener alive.
    final callService = Provider.of<AgoraCallService>(context, listen: false);
    callService.removeListener(_handleCallStateChange);
    super.dispose();
  }

  bool _isPopping = false;
  void _handleCallStateChange() {
    if (_isPopping || !mounted) return;
    final callService = Provider.of<AgoraCallService>(context, listen: false);

    // Track if we ever connected (joined channel)
    if (callService.isInCall) {
      _wasConnected = true;
    }

    if (!callService.isInCall && _wasConnected) {
      debugPrint("VoiceCallView: Call ended — popping screen");
      _isPopping = true;
      callService.removeListener(_handleCallStateChange);
      navigatorKey.currentState?.pop();
    }
  }

  @override
  Widget build(BuildContext context) {
    return PopScope(
      canPop: false,
      child: Scaffold(
        backgroundColor: const Color(0xFF1a1a2e),
        body: Consumer<AgoraCallService>(
          builder: (context, callService, child) {
            return SafeArea(
              child: Column(
                children: [
                  const Spacer(flex: 2),
                  // Profile image
                  _buildAvatar(),
                  const SizedBox(height: 24),
                  // Name
                  Text(
                    widget.callerName,
                    style: const TextStyle(
                      color: Colors.white,
                      fontSize: 28,
                      fontWeight: FontWeight.w600,
                    ),
                  ),
                  const SizedBox(height: 12),
                  // Status
                  Text(
                    _getStatusText(callService),
                    style: TextStyle(
                      color: Colors.white.withOpacity(0.7),
                      fontSize: 16,
                    ),
                  ),
                  // Duration
                  if (callService.remoteUserJoined) ...[
                    const SizedBox(height: 8),
                    Text(
                      callService.formattedDuration,
                      style: const TextStyle(
                        color: Colors.white70,
                        fontSize: 20,
                        fontWeight: FontWeight.w500,
                        fontFeatures: [FontFeature.tabularFigures()],
                      ),
                    ),
                  ],
                  const Spacer(flex: 3),
                  // Call controls
                  _buildCallControls(context, callService),
                  const SizedBox(height: 50),
                ],
              ),
            );
          },
        ),
      ),
    );
  }

  Widget _buildAvatar() {
    return Container(
      width: 120,
      height: 120,
      decoration: BoxDecoration(
        shape: BoxShape.circle,
        gradient: LinearGradient(
          colors: [
            primaryColor.withOpacity(0.6),
            softBlue.withOpacity(0.6),
          ],
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
        ),
        boxShadow: [
          BoxShadow(
            color: primaryColor.withOpacity(0.3),
            blurRadius: 30,
            spreadRadius: 5,
          ),
        ],
      ),
      child: ClipOval(
        child: widget.callerImage != null && widget.callerImage!.isNotEmpty
            ? CachedNetworkImage(
                imageUrl: widget.callerImage!,
                fit: BoxFit.cover,
                placeholder: (_, __) => _buildInitials(),
                errorWidget: (_, __, ___) => _buildInitials(),
              )
            : _buildInitials(),
      ),
    );
  }

  Widget _buildInitials() {
    return Center(
      child: Text(
        widget.callerName.isNotEmpty ? widget.callerName[0].toUpperCase() : '?',
        style: const TextStyle(
          color: Colors.white,
          fontSize: 48,
          fontWeight: FontWeight.bold,
        ),
      ),
    );
  }

  String _getStatusText(AgoraCallService callService) {
    if (callService.remoteUserJoined) {
      return 'Görüşme devam ediyor';
    }
    if (callService.isInCall) {
      return widget.isOutgoing ? 'Aranıyor...' : 'Bağlanıyor...';
    }
    return 'Bağlantı kuruluyor...';
  }

  Widget _buildCallControls(
      BuildContext context, AgoraCallService callService) {
    return Row(
      mainAxisAlignment: MainAxisAlignment.spaceEvenly,
      children: [
        // Mute button
        _buildControlButton(
          icon: callService.isMuted ? Icons.mic_off : Icons.mic,
          label: callService.isMuted ? 'Unmute' : 'Mute',
          color: callService.isMuted ? Colors.red.shade400 : Colors.white24,
          onTap: () => callService.toggleMute(),
        ),
        // End call button
        _buildControlButton(
          icon: Icons.call_end,
          label: 'Kapat',
          color: Colors.red,
          size: 70,
          onTap: () async {
            if (_isPopping) return;
            _isPopping = true;
            // Remove listener before popping to avoid double-pops
            callService.removeListener(_handleCallStateChange);
            await callService.leaveCall();
            navigatorKey.currentState?.pop();
          },
        ),
        // Speaker button
        _buildControlButton(
          icon:
              callService.isSpeakerOn ? Icons.volume_up : Icons.volume_off,
          label: callService.isSpeakerOn ? 'Speaker' : 'Ear',
          color:
              callService.isSpeakerOn ? primaryColor : Colors.white24,
          onTap: () => callService.toggleSpeaker(),
        ),
      ],
    );
  }

  Widget _buildControlButton({
    required IconData icon,
    required String label,
    required Color color,
    required VoidCallback onTap,
    double size = 56,
  }) {
    return Column(
      mainAxisSize: MainAxisSize.min,
      children: [
        GestureDetector(
          onTap: onTap,
          child: Container(
            width: size,
            height: size,
            decoration: BoxDecoration(
              color: color,
              shape: BoxShape.circle,
            ),
            child: Icon(
              icon,
              color: Colors.white,
              size: size * 0.45,
            ),
          ),
        ),
        const SizedBox(height: 8),
        Text(
          label,
          style: const TextStyle(color: Colors.white70, fontSize: 12),
        ),
      ],
    );
  }
}

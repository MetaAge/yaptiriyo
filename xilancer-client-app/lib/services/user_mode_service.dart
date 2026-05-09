import 'package:flutter/material.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:xilancer/customizations.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/services/project_list_service.dart.dart';
import 'package:xilancer/services/my_projects_service.dart';
import 'package:xilancer/services/my_order_list_service.dart';
import 'package:xilancer/services/my_proposals_service.dart';
import 'package:xilancer/services/dynamics/dynamics_service.dart';
import 'package:xilancer/services/chat_list_service.dart';
import 'package:xilancer/services/notifications_list_service.dart';
import 'package:xilancer/services/wallet_history_service.dart';
import 'package:xilancer/services/message_notification_count_service.dart';

enum UserMode { client, freelancer }

class UserModeService extends ChangeNotifier {
  static UserModeService? _instance;
  static UserModeService get instance => _instance ??= UserModeService();

  UserMode _currentMode = UserMode.client;

  UserMode get currentMode => _currentMode;

  String get baseApiUrl =>
      _currentMode == UserMode.freelancer ? baseEndPoint : baseClientEndPoint;

  bool get isFreelancer => _currentMode == UserMode.freelancer;
  bool get isClient => _currentMode == UserMode.client;

  Future<void> initializeMode() async {
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    final String? modeString = prefs.getString('user_mode');
    if (modeString != null) {
      _currentMode =
          modeString == 'freelancer' ? UserMode.freelancer : UserMode.client;
    } else {
      // Default based on login type if available, otherwise client
      final String? userType = prefs.getString('user_type');
      if (userType == 'freelancer') {
        _currentMode = UserMode.freelancer;
      } else {
        _currentMode = UserMode.client;
      }
    }
    notifyListeners();
  }

  Future<void> setMode(UserMode mode) async {
    if (_currentMode == mode) return;
    _currentMode = mode;
    final SharedPreferences prefs = await SharedPreferences.getInstance();
    await prefs.setString(
        'user_mode', mode == UserMode.freelancer ? 'freelancer' : 'client');
    notifyListeners();
  }

  void onModeChange(BuildContext context) {
    Provider.of<ProjectListService>(context, listen: false)
        .fetchProjectList(refreshing: true);
    if (isFreelancer) {
      Provider.of<MyProjectsService>(context, listen: false).fetchMyProjects();
      Provider.of<MyProposalsService>(context, listen: false).fetchOrderList();
    }
    Provider.of<MyOrderListService>(context, listen: false).fetchOrderList();
    Provider.of<ChatListService>(context, listen: false).fetchChatList();
    Provider.of<NotificationsListService>(context, listen: false).fetchNotificationsList();
    Provider.of<WalletHistoryService>(context, listen: false).fetchWalletHistory();
    Provider.of<MessageNotificationCountService>(context, listen: false).fetchMN();
    try {
      Provider.of<DynamicsService>(context, listen: false).notifyListeners();
    } catch (e) {}
  }

  void toggleMode() {
    setMode(
        _currentMode == UserMode.client ? UserMode.freelancer : UserMode.client);
  }

  static UserModeService of(BuildContext context, {bool listen = true}) =>
      Provider.of<UserModeService>(context, listen: listen);
}

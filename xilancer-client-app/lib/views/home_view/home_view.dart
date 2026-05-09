import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/services/message_notification_count_service.dart';
import 'package:xilancer/services/push_notification_service.dart';
import 'package:xilancer/services/user_address_service.dart';

import '../../view_models/home_view_model/home_view_model.dart';
import '../home_view/components/home_app_bar.dart';
import '../projects_list/projects_list.dart';
import '../../services/user_mode_service.dart';

class HomeView extends StatelessWidget {
  const HomeView({super.key});

  @override
  Widget build(BuildContext context) {
    final hvm = HomeViewModel.instance;
    Provider.of<MessageNotificationCountService>(context, listen: false)
        .fetchMN();
    final as = Provider.of<UserAddressService>(context, listen: false);
    if (as.addressModel == null && !as.isLoading) {
      as.fetchAddresses();
    }
    PushNotificationService().updateDeviceToken(forceUpdate: true);
    return Column(
      children: [
        const HomeAppBar(),
        Expanded(
          child: Container(
            color: context.dProvider.black9,
            child: Consumer<UserModeService>(builder: (context, um, child) {
              return const ProjectsList();
            }),
          ),
        ),
      ],
    );
  }
}

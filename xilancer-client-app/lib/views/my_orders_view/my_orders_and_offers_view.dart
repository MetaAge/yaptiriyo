import 'package:flutter/material.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/views/my_offers_view/components/my_offers_body.dart';
import 'package:xilancer/views/my_orders_view/components/my_orders_body.dart';

class MyOrdersAndOffersView extends StatelessWidget {
  const MyOrdersAndOffersView({super.key});

  @override
  Widget build(BuildContext context) {
    return DefaultTabController(
      length: 2,
      child: Scaffold(
        appBar: AppBar(
          title: Text(LocalKeys.myOrder),
          bottom: TabBar(
            dividerColor: Colors.transparent,
            indicatorColor: context.dProvider.primaryColor,
            labelColor: context.dProvider.primaryColor,
            unselectedLabelColor: context.dProvider.black5,
            tabs: [
              Tab(text: LocalKeys.myOrder),
              Tab(text: LocalKeys.myOffers),
            ],
          ),
        ),
        body: const TabBarView(
          children: [
            MyOrdersBody(),
            MyOffersBody(),
          ],
        ),
      ),
    );
  }
}

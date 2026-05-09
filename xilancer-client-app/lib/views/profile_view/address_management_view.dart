import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/user_address_service.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/views/profile_view/components/address_card.dart';
import 'package:xilancer/views/profile_view/components/address_form_modal.dart';

class AddressManagementView extends StatefulWidget {
  static const routeName = 'address_management_view';
  const AddressManagementView({super.key});

  @override
  State<AddressManagementView> createState() => _AddressManagementViewState();
}

class _AddressManagementViewState extends State<AddressManagementView> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      final as = Provider.of<UserAddressService>(context, listen: false);
      if (as.addressModel == null) {
        as.fetchAddresses();
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: const NavigationPopIcon(),
        title: Text(LocalKeys.myAddresses),
      ),
      body: Consumer<UserAddressService>(
        builder: (context, as, child) {
          if (as.addressModel == null) {
            return const Center(child: CircularProgressIndicator());
          }
          return as.addressModel?.addresses?.isEmpty ?? true
              ? Center(
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Icon(Icons.location_off_outlined, size: 60, color: context.dProvider.black8),
                      16.toHeight,
                      Text(LocalKeys.noResultFound, style: context.titleMedium?.copyWith(color: context.dProvider.black5)),
                    ],
                  ),
                )
              : ListView.separated(
                  padding: const EdgeInsets.all(20),
                  itemCount: as.addressModel!.addresses!.length,
                  separatorBuilder: (context, index) => 16.toHeight,
                  itemBuilder: (context, index) {
                    final address = as.addressModel!.addresses![index];
                    return AddressCard(address: address);
                  },
                );
        },
      ),
      bottomNavigationBar: Padding(
        padding: const EdgeInsets.all(20),
        child: CustomButton(
          onPressed: () {
            showModalBottomSheet(
              context: context,
              isScrollControlled: true,
              backgroundColor: Colors.transparent,
              builder: (context) => const AddressFormModal(),
            );
          },
          btText: LocalKeys.addNewAddress,
          isLoading: false,
        ),
      ),
    );
  }
}

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/user_address_service.dart';
import 'package:xilancer/view_models/place_order_view_model/place_order_view_model.dart';
import 'package:xilancer/views/profile_view/address_management_view.dart';
import 'package:xilancer/views/profile_view/components/address_form_modal.dart';
import 'package:xilancer/utils/components/custom_button.dart';

class AddressSelectionWidget extends StatelessWidget {
  const AddressSelectionWidget({super.key});

  @override
  Widget build(BuildContext context) {
    final pom = PlaceOrderViewViewModel.instance;
    return Consumer<UserAddressService>(
      builder: (context, as, child) {
        if (as.addressModel == null) {
          as.fetchAddresses();
          return const Center(child: CircularProgressIndicator());
        }

        if (as.addressModel!.addresses!.isEmpty) {
          return InkWell(
            onTap: () {
              showModalBottomSheet(
                context: context,
                isScrollControlled: true,
                backgroundColor: Colors.transparent,
                builder: (context) => const AddressFormModal(),
              ).then((value) {
                if (as.addressModel!.addresses!.isNotEmpty) {
                  pom.selectedAddress.value = as.addressModel!.addresses!.firstWhere((element) => element.isDefault == true, orElse: () => as.addressModel!.addresses!.first);
                }
              });
            },
            child: Container(
              padding: const EdgeInsets.all(16),
              decoration: BoxDecoration(
                border: Border.all(color: context.dProvider.warningColor),
                borderRadius: BorderRadius.circular(8),
                color: context.dProvider.warningColor.withOpacity(0.05),
              ),
              child: Row(
                children: [
                  Icon(Icons.add_location_alt_outlined, color: context.dProvider.warningColor),
                  12.toWidth,
                  Expanded(
                    child: Text(
                      "Lütfen sipariş için bir adres ekleyin",
                      style: context.titleSmall?.copyWith(color: context.dProvider.warningColor),
                    ),
                  ),
                  const Icon(Icons.arrow_forward_ios, size: 16),
                ],
              ),
            ),
          );
        }

        if (pom.selectedAddress.value == null) {
          pom.selectedAddress.value = as.addressModel!.addresses!.firstWhere((element) => element.isDefault == true, orElse: () => as.addressModel!.addresses!.first);
        }

        return ValueListenableBuilder(
          valueListenable: pom.selectedAddress,
          builder: (context, selected, child) {
            return Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(LocalKeys.selectAddress, style: context.titleMedium?.bold6),
                    TextButton(
                      onPressed: () {
                        _showAddressPicker(context, as);
                      },
                      child: Text(LocalKeys.changePassword.replaceFirst("Şifreyi", "Adresi"), style: context.bodySmall?.copyWith(color: context.dProvider.primaryColor)),
                    ),
                  ],
                ),
                Container(
                  padding: const EdgeInsets.all(16),
                  decoration: BoxDecoration(
                    border: Border.all(color: context.dProvider.black8),
                    borderRadius: BorderRadius.circular(8),
                  ),
                  child: Row(
                    children: [
                      Icon(Icons.location_on_outlined, color: context.dProvider.primaryColor),
                      12.toWidth,
                      Expanded(
                        child: Column(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Text(selected?.name ?? "", style: context.titleSmall?.bold6),
                            Text(
                              "${selected?.addressDetails ?? ""}, ${selected?.city?.name ?? ""}",
                              style: context.bodySmall?.copyWith(color: context.dProvider.black5),
                              maxLines: 1,
                              overflow: TextOverflow.ellipsis,
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            );
          },
        );
      },
    );
  }

  void _showAddressPicker(BuildContext context, UserAddressService as) {
    final pom = PlaceOrderViewViewModel.instance;
    showModalBottomSheet(
      context: context,
      backgroundColor: Colors.transparent,
      builder: (context) {
        return Container(
          decoration: BoxDecoration(
            color: context.dProvider.whiteColor,
            borderRadius: const BorderRadius.vertical(top: Radius.circular(24)),
          ),
          padding: const EdgeInsets.all(20),
          child: Column(
            mainAxisSize: MainAxisSize.min,
            children: [
              Text(LocalKeys.selectAddress, style: context.titleLarge?.bold6),
              16.toHeight,
              Expanded(
                child: ListView.separated(
                  itemCount: as.addressModel!.addresses!.length,
                  separatorBuilder: (context, index) => 12.toHeight,
                  itemBuilder: (context, index) {
                    final address = as.addressModel!.addresses![index];
                    return ListTile(
                      onTap: () {
                        pom.selectedAddress.value = address;
                        Navigator.pop(context);
                      },
                      title: Text(address.name ?? ""),
                      subtitle: Text(address.addressDetails ?? ""),
                      trailing: pom.selectedAddress.value?.id == address.id ? Icon(Icons.check_circle, color: context.dProvider.primaryColor) : null,
                    );
                  },
                ),
              ),
              16.toHeight,
              CustomButton(
                onPressed: () {
                  Navigator.pop(context);
                  context.toNamed(AddressManagementView.routeName);
                },
                btText: LocalKeys.myAddresses,
                isLoading: false,
              ),
            ],
          ),
        );
      },
    );
  }
}

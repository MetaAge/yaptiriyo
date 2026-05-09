import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/models/user_address_model.dart';
import 'package:xilancer/services/user_address_service.dart';
import 'package:xilancer/utils/components/alerts.dart';
import 'package:xilancer/views/profile_view/components/address_form_modal.dart';

class AddressCard extends StatelessWidget {
  final UserAddress address;
  const AddressCard({super.key, required this.address});

  @override
  Widget build(BuildContext context) {
    return Container(
      padding: const EdgeInsets.all(16),
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(
          color: address.isDefault == true ? context.dProvider.primaryColor : context.dProvider.black8,
          width: address.isDefault == true ? 1.5 : 1,
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.05),
            blurRadius: 10,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.start,
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              Expanded(
                child: Text(
                  address.name ?? "",
                  style: context.titleMedium?.bold6.copyWith(
                    color: address.isDefault == true ? context.dProvider.primaryColor : context.dProvider.black3,
                  ),
                ),
              ),
              if (address.isDefault == true)
                Container(
                  padding: const EdgeInsets.symmetric(horizontal: 8, vertical: 4),
                  decoration: BoxDecoration(
                    color: context.dProvider.primaryColor.withOpacity(0.1),
                    borderRadius: BorderRadius.circular(4),
                  ),
                  child: Text(
                    "Varsayılan",
                    style: context.bodySmall?.copyWith(color: context.dProvider.primaryColor, fontWeight: FontWeight.bold),
                  ),
                ),
            ],
          ),
          8.toHeight,
          Text(
            address.addressDetails ?? "",
            style: context.bodyMedium?.copyWith(color: context.dProvider.black5),
          ),
          4.toHeight,
          Text(
            "${address.city?.name ?? ""}, ${address.state?.name ?? ""}, ${address.country?.name ?? ""}",
            style: context.bodySmall?.copyWith(color: context.dProvider.black7),
          ),
          if (address.phone != null && address.phone!.isNotEmpty) ...[
            8.toHeight,
            Row(
              children: [
                Icon(Icons.phone_outlined, size: 16, color: context.dProvider.black7),
                8.toWidth,
                Text(address.phone!, style: context.bodySmall?.copyWith(color: context.dProvider.black5)),
              ],
            ),
          ],
          16.toHeight,
          const Divider(),
          Row(
            mainAxisAlignment: MainAxisAlignment.end,
            children: [
              if (address.isDefault != true)
                TextButton(
                  onPressed: () {
                    context.read<UserAddressService>().makeDefault(address.id);
                  },
                  child: Text(LocalKeys.setAsDefault, style: context.bodySmall?.copyWith(color: context.dProvider.primaryColor)),
                ),
              IconButton(
                onPressed: () {
                  showModalBottomSheet(
                    context: context,
                    isScrollControlled: true,
                    backgroundColor: Colors.transparent,
                    builder: (context) => AddressFormModal(address: address),
                  );
                },
                icon: Icon(Icons.edit_outlined, size: 20, color: context.dProvider.black5),
              ),
              IconButton(
                onPressed: () {
                  Alerts().confirmationAlert(
                    context: context,
                    title: LocalKeys.areYouSure,
                    buttonText: LocalKeys.delete,
                    onConfirm: () async {
                      await context.read<UserAddressService>().deleteAddress(address.id);
                    },
                  );
                },
                icon: Icon(Icons.delete_outline, size: 20, color: context.dProvider.warningColor),
              ),
            ],
          ),
        ],
      ),
    );
  }
}

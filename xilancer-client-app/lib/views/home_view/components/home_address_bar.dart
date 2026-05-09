import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/constant_helper.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/user_address_service.dart';
import 'package:xilancer/views/profile_view/address_management_view.dart';
import 'package:xilancer/views/sign_in_view/sign_in_view.dart';

class HomeAddressBar extends StatelessWidget {
  const HomeAddressBar({super.key});

  @override
  Widget build(BuildContext context) {
    return Consumer<UserAddressService>(
      builder: (context, as, child) {
        if (as.addressModel == null && !as.isLoading && getToken.isNotEmpty) {
          WidgetsBinding.instance.addPostFrameCallback((_) {
            as.fetchAddresses();
          });
        }

        final address = as.defaultAddress;
        final hasAddress = address != null && address.id != null;

        return InkWell(
          onTap: () {
            if (getToken.isEmpty) {
              context.toNamed(SignInView.routeName);
              return;
            }
            if (hasAddress) {
              _showAddressSelection(context, as);
            } else {
              context.toNamed(AddressManagementView.routeName);
            }
          },
          child: Container(
            padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 10),
            decoration: BoxDecoration(
              color: Colors.white.withOpacity(0.12),
              borderRadius: BorderRadius.circular(12),
              border: Border.all(color: Colors.white.withOpacity(0.1)),
            ),
            child: Row(
              children: [
                const Icon(
                  Icons.location_on_rounded,
                  color: Colors.white,
                  size: 20,
                ),
                const SizedBox(width: 10),
                Expanded(
                  child: Column(
                    crossAxisAlignment: CrossAxisAlignment.start,
                    mainAxisSize: MainAxisSize.min,
                    children: [
                      Text(
                        hasAddress ? (address.name ?? LocalKeys.selectAddress) : LocalKeys.pleaseSelectAddress,
                        style: context.bodyMedium?.copyWith(
                          color: Colors.white,
                          fontWeight: FontWeight.bold,
                          fontSize: 13,
                        ),
                        maxLines: 1,
                        overflow: TextOverflow.ellipsis,
                      ),
                      if (hasAddress)
                        Text(
                          "${address.addressDetails ?? ""}${address.city?.name != null ? ", ${address.city?.name}" : ""}",
                          style: context.bodySmall?.copyWith(
                            color: Colors.white70,
                            fontSize: 11,
                          ),
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                        ),
                    ],
                  ),
                ),
                const Icon(
                  Icons.keyboard_arrow_down_rounded,
                  color: Colors.white70,
                  size: 20,
                ),
              ],
            ),
          ),
        );
      },
    );
  }

  void _showAddressSelection(BuildContext context, UserAddressService as) {
    showModalBottomSheet(
      context: context,
      backgroundColor: Colors.transparent,
      isScrollControlled: true,
      builder: (context) {
        return Container(
          padding: const EdgeInsets.symmetric(vertical: 24),
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
              24.toHeight,
              Padding(
                padding: const EdgeInsets.symmetric(horizontal: 24),
                child: Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(
                      LocalKeys.selectAddress,
                      style: context.titleMedium?.bold6,
                    ),
                    TextButton(
                      onPressed: () {
                        Navigator.pop(context);
                        context.toNamed(AddressManagementView.routeName);
                      },
                      child: Text(
                        LocalKeys.edit,
                        style: TextStyle(color: context.dProvider.primaryColor),
                      ),
                    ),
                  ],
                ),
              ),
              const SizedBox(height: 8),
              ConstrainedBox(
                constraints: BoxConstraints(
                  maxHeight: MediaQuery.of(context).size.height * 0.5,
                ),
                child: ListView.separated(
                  shrinkWrap: true,
                  padding: const EdgeInsets.symmetric(horizontal: 24, vertical: 8),
                  itemCount: as.addressModel?.addresses?.length ?? 0,
                  separatorBuilder: (context, index) => const Divider(height: 1),
                  itemBuilder: (context, index) {
                    final address = as.addressModel!.addresses![index];
                    final isSelected = address.isDefault == true;
                    return ListTile(
                      contentPadding: EdgeInsets.zero,
                      onTap: () async {
                        Navigator.pop(context);
                        if (!isSelected) {
                          await as.makeDefault(address.id);
                        }
                      },
                      leading: Container(
                        padding: const EdgeInsets.all(8),
                        decoration: BoxDecoration(
                          color: isSelected
                              ? context.dProvider.primaryColor.withOpacity(0.1)
                              : context.dProvider.black9,
                          shape: BoxShape.circle,
                        ),
                        child: Icon(
                          Icons.location_on_outlined,
                          color: isSelected
                              ? context.dProvider.primaryColor
                              : context.dProvider.black5,
                          size: 20,
                        ),
                      ),
                      title: Text(
                        address.name ?? "",
                        style: context.bodyMedium?.copyWith(
                          fontWeight: isSelected ? FontWeight.bold : FontWeight.normal,
                          color: isSelected ? context.dProvider.primaryColor : context.dProvider.black2,
                        ),
                      ),
                      subtitle: Text(
                        address.addressDetails ?? "",
                        style: context.bodySmall,
                        maxLines: 1,
                        overflow: TextOverflow.ellipsis,
                      ),
                      trailing: isSelected
                          ? Icon(Icons.check_circle_rounded, color: context.dProvider.primaryColor)
                          : null,
                    );
                  },
                ),
              ),
              20.toHeight,
            ],
          ),
        );
      },
    );
  }
}

class HomeAddressBarCompact extends StatelessWidget {
  const HomeAddressBarCompact({super.key});

  @override
  Widget build(BuildContext context) {
    return Consumer<UserAddressService>(
      builder: (context, as, child) {
        final address = as.defaultAddress;
        final hasAddress = address != null && address.id != null;

        return InkWell(
          onTap: () {
            if (getToken.isEmpty) {
              context.toNamed(SignInView.routeName);
              return;
            }
            if (hasAddress) {
              _showAddressSelection(context, as);
            } else {
              context.toNamed(AddressManagementView.routeName);
            }
          },
          child: Row(
            mainAxisSize: MainAxisSize.min,
            children: [
              const Icon(
                Icons.location_on_rounded,
                color: Colors.white70,
                size: 14,
              ),
              const SizedBox(width: 4),
              Flexible(
                child: Text(
                  hasAddress
                      ? "${address.name}: ${address.addressDetails ?? ""}"
                      : LocalKeys.pleaseSelectAddress,
                  style: context.bodySmall?.copyWith(
                    color: Colors.white70,
                    fontSize: 11,
                  ),
                  maxLines: 1,
                  overflow: TextOverflow.ellipsis,
                ),
              ),
              const Icon(
                Icons.keyboard_arrow_down_rounded,
                color: Colors.white70,
                size: 16,
              ),
            ],
          ),
        );
      },
    );
  }

  void _showAddressSelection(BuildContext context, UserAddressService as) {
    const HomeAddressBar()._showAddressSelection(context, as);
  }
}

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/models/country_model.dart';
import 'package:xilancer/models/state_model.dart';
import 'package:xilancer/models/city_dropdown_model.dart';
import 'package:xilancer/models/user_address_model.dart' as model;
import 'package:xilancer/services/location/country_dropdown_service.dart';
import 'package:xilancer/services/location/state_dropdown_service.dart';
import 'package:xilancer/services/location/city_dropdown_service.dart';
import 'package:xilancer/services/user_address_service.dart';
import 'package:xilancer/utils/components/city_dropdown.dart';
import 'package:xilancer/utils/components/country_dropdown.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/utils/components/field_with_label.dart';
import 'package:xilancer/utils/components/state_dropdown.dart';

class AddressFormModal extends StatefulWidget {
  final model.UserAddress? address;
  const AddressFormModal({super.key, this.address});

  @override
  State<AddressFormModal> createState() => _AddressFormModalState();
}

class _AddressFormModalState extends State<AddressFormModal> {
  final formKey = GlobalKey<FormState>();
  final nameController = TextEditingController();
  final addressController = TextEditingController();
  final zipCodeController = TextEditingController();
  final selectedCountry = ValueNotifier<Country?>(null);
  final selectedState = ValueNotifier<States?>(null);
  final selectedCity = ValueNotifier<City?>(null);
  bool isDefault = false;
  bool isLoading = false;

  @override
  void initState() {
    super.initState();
    if (widget.address != null) {
      nameController.text = widget.address!.name ?? "";
      addressController.text = widget.address!.addressDetails ?? "";
      zipCodeController.text = widget.address!.zipCode ?? "";
      isDefault = widget.address!.isDefault ?? false;
      if (widget.address!.country != null) {
        selectedCountry.value =
            Country(id: widget.address!.countryId, name: widget.address!.country!.name);
      }
      if (widget.address!.state != null) {
        selectedState.value =
            States(id: widget.address!.stateId, name: widget.address!.state!.name);
      }
      if (widget.address!.city != null) {
        selectedCity.value = City(id: widget.address!.cityId, name: widget.address!.city!.name);
      }
    }
    if (selectedCountry.value == null) {
      selectedCountry.value = Country(id: 15, name: "Türkiye");
    }
  }

  @override
  Widget build(BuildContext context) {
    return Container(
      decoration: BoxDecoration(
        color: context.dProvider.whiteColor,
        borderRadius: const BorderRadius.vertical(top: Radius.circular(24)),
      ),
      padding: EdgeInsets.only(
        left: 20,
        right: 20,
        top: MediaQuery.of(context).padding.top + 20,
        bottom: MediaQuery.of(context).viewInsets.bottom + 20,
      ),
      child: SafeArea(
        top: true,
        child: SingleChildScrollView(
          padding: const EdgeInsets.only(top: 10),
          child: Form(
            key: formKey,
            child: Column(
              mainAxisSize: MainAxisSize.min,
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Row(
                  mainAxisAlignment: MainAxisAlignment.spaceBetween,
                  children: [
                    Text(
                      widget.address == null ? LocalKeys.addNewAddress : LocalKeys.editAddress,
                      style: context.titleLarge?.bold6,
                    ),
                    IconButton(
                      onPressed: () => Navigator.pop(context),
                      icon: const Icon(Icons.close),
                    ),
                  ],
                ),
                16.toHeight,
                FieldWithLabel(
                  label: LocalKeys.addressName,
                  hintText: "Ev, İş vb.",
                  controller: nameController,
                  validator: (p0) => p0!.isEmpty ? LocalKeys.enterValidName : null,
                ),
                FieldWithLabel(
                  label: LocalKeys.addressDetails,
                  hintText: LocalKeys.addressDetails,
                  controller: addressController,
                  maxLines: 3,
                  validator: (p0) => p0!.isEmpty ? LocalKeys.enterSomeDescription : null,
                ),
                // Country is fixed to Turkey
                StateDropdown(
                  countryNotifier: selectedCountry,
                  stateNotifier: selectedState,
                ),
                CityDropdown(
                  label: LocalKeys.district,
                  hintText: LocalKeys.selectDistrict,
                  stateNotifier: selectedState,
                  cityNotifier: selectedCity,
                ),
                FieldWithLabel(
                  label: LocalKeys.zipCode,
                  hintText: LocalKeys.zipCode,
                  controller: zipCodeController,
                ),
                SwitchListTile(
                  contentPadding: EdgeInsets.zero,
                  title: Text(LocalKeys.setAsDefault, style: context.titleSmall),
                  value: isDefault,
                  onChanged: (val) => setState(() => isDefault = val),
                ),
                24.toHeight,
                CustomButton(
                  onPressed: _submit,
                  btText: LocalKeys.saveChanges,
                  isLoading: isLoading,
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }

  _submit() async {
    if (!formKey.currentState!.validate()) return;
    if (selectedCountry.value == null || selectedState.value == null || selectedCity.value == null) {
      "Lütfen tüm alanları doldurun".showToast();
      return;
    }

    setState(() => isLoading = true);

    final data = {
      "name": nameController.text,
      "address_details": addressController.text,
      "country_id": selectedCountry.value!.id.toString(),
      "state_id": selectedState.value!.id.toString(),
      "city_id": selectedCity.value!.id.toString(),
      "zip_code": zipCodeController.text,
      "is_default": isDefault ? "1" : "0",
    };

    bool success;
    if (widget.address == null) {
      success = await context.read<UserAddressService>().addAddress(data);
    } else {
      success = await context.read<UserAddressService>().updateAddress(widget.address!.id, data);
    }

    setState(() => isLoading = false);

    if (success) {
      Navigator.pop(context);
    }
  }
}

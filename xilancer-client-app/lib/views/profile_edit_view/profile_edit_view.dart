import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/services/account_delete_service.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/svg_assets.dart';
import 'package:xilancer/utils/components/city_dropdown.dart';
import 'package:xilancer/utils/components/country_dropdown.dart';
import 'package:xilancer/utils/components/state_dropdown.dart';
import 'package:xilancer/view_models/profile_edit_view_model.dart/profile_edit_view_model.dart';
import 'package:xilancer/views/profile_settings_view/components/profile_info_avatar.dart';
import 'package:xilancer/views/sign_up_view/components/name_field.dart';

import '../../utils/components/custom_preloader.dart';
import '../../utils/components/field_with_label.dart';
import '../../utils/components/navigation_pop_icon.dart';
import '../../utils/components/custom_button.dart';
import '../../helper/local_keys.g.dart';

class ProfileEditView extends StatefulWidget {
  static const routeName = 'profile_edit_view';
  const ProfileEditView({super.key});

  @override
  State<ProfileEditView> createState() => _ProfileEditViewState();
}

class _ProfileEditViewState extends State<ProfileEditView> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      ProfileEditViewModel.instance.initEdit(context);
    });
  }

  @override
  Widget build(BuildContext context) {
    final pev = ProfileEditViewModel.instance;

    return Scaffold(
      appBar: AppBar(
        leadingWidth: 80,
        leading: const NavigationPopIcon(),
        title: Text(LocalKeys.editProfile),
      ),
      body: ValueListenableBuilder(
        valueListenable: pev.initialLoading,
        builder: (context, initialLoading, child) {
          if (initialLoading) {
            return const Center(child: CustomPreloader());
          }
          return SingleChildScrollView(
            padding: const EdgeInsets.all(20),
            child: Container(
              padding: const EdgeInsets.all(20),
              decoration: BoxDecoration(
                borderRadius: BorderRadius.circular(8),
                color: context.dProvider.whiteColor,
              ),
              child: Form(
                key: pev.formKey,
                child: Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Row(
                      children: [
                        const Expanded(
                          flex: 8,
                          child: ProfileInfoAvatar(
                            editing: true,
                          ),
                        ),
                        12.toWidth,
                        Expanded(
                          flex: 16,
                          child: Column(
                            crossAxisAlignment: CrossAxisAlignment.start,
                            children: [
                              SizedBox(
                                width: double.infinity,
                                child: ElevatedButton.icon(
                                    onPressed: () {
                                      pev.setProfileImage();
                                    },
                                    icon: SvgAssets.gallery.toSVGSized(20,
                                        color: context.dProvider.whiteColor),
                                    label: Text(LocalKeys.changePhoto)),
                              ),
                              4.toHeight,
                              Text(
                                LocalKeys.profilePhotoShouldBeMinimum,
                                style: context.titleSmall
                                    ?.copyWith(color: context.dProvider.black5),
                              )
                            ],
                          ),
                        ),
                      ],
                    ),
                    16.toHeight,
                    NameField(
                      firstNameController: pev.firstNameController,
                      lastNameController: pev.lastNameController,
                    ),
                    FieldWithLabel(
                      label: LocalKeys.aboutMe,
                      hintText: LocalKeys.enterSomeDescription,
                      controller: pev.descriptionController,
                      maxLines: 5,
                    ),
                    FieldWithLabel(
                      label: LocalKeys.email,
                      hintText: LocalKeys.enterEmail,
                      keyboardType: TextInputType.emailAddress,
                      controller: pev.emailController,
                      validator: (value) {
                        if (!value!.validateEmail) {
                          return LocalKeys.enterValidEmailAddress;
                        }
                        return null;
                      },
                    ),
                    FieldWithLabel(
                      label: LocalKeys.phoneNumber,
                      hintText: LocalKeys.enterPhone,
                      keyboardType: TextInputType.number,
                      controller: pev.phoneController,
                      validator: (value) {
                        if (value!.length < 5) {
                          return LocalKeys.enterValidPhone;
                        }
                        return null;
                      },
                    ),
                    StateDropdown(
                      label: LocalKeys.state,
                      hintText: LocalKeys.selectState,
                      countryNotifier: pev.selectedCountry,
                      stateNotifier: pev.selectedState,
                    ),
                    CityDropdown(
                      label: LocalKeys.district,
                      hintText: LocalKeys.selectDistrict,
                      stateNotifier: pev.selectedState,
                      cityNotifier: pev.selectedCity,
                    ),
                    if (context.isFreelancer)
                      FieldWithLabel(
                        label: LocalKeys.professionalTitle,
                        hintText: LocalKeys.enterTitle,
                        controller: pev.titleController,
                      ),
                    20.toHeight,
                    const Divider(),
                    20.toHeight,
                    InkWell(
                      onTap: () async {
                        final delete = await showDialog(
                          context: context,
                          builder: (context) => AlertDialog(
                            title: Text(LocalKeys.deleteAccount),
                            content: const Text(
                                "Hesabınızı silmek istediğinizden emin misiniz? Bu işlem geri alınamaz."),
                            actions: [
                              TextButton(
                                onPressed: () => Navigator.pop(context, false),
                                child: Text(LocalKeys.cancel),
                              ),
                              TextButton(
                                onPressed: () => Navigator.pop(context, true),
                                child: Text(LocalKeys.delete,
                                    style: const TextStyle(color: Colors.red)),
                              ),
                            ],
                          ),
                        );
                        if (delete == true) {
                          final ads = Provider.of<AccountDeleteService>(context,
                              listen: false);
                          final deleted = await ads.tryAccountDelete();
                          if (deleted == true) {
                            Navigator.pushNamedAndRemoveUntil(
                                context, 'splash_view', (route) => false);
                          }
                        }
                      },
                      child: Padding(
                        padding: const EdgeInsets.symmetric(vertical: 8.0),
                        child: Row(
                          children: [
                            const Icon(Icons.delete_forever_rounded,
                                color: Colors.red),
                            10.toWidth,
                            Text(
                              LocalKeys.deleteAccount,
                              style: const TextStyle(
                                  color: Colors.red,
                                  fontWeight: FontWeight.bold),
                            ),
                          ],
                        ),
                      ),
                    ),
                  ],
                ),
              ),
            ),
          );
        },
      ),
      bottomNavigationBar: Container(
        margin: const EdgeInsets.all(20),
        color: Colors.transparent,
        child: ValueListenableBuilder(
          valueListenable: pev.loading,
          builder: (context, loading, child) => CustomButton(
            onPressed: () async {
              pev.updateProfileInfo(context);
            },
            btText: LocalKeys.saveChanges,
            isLoading: loading,
          ),
        ),
      ),
    );
  }
}

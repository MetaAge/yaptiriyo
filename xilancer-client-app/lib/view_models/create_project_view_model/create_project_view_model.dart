import 'dart:io';
import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_summernote/flutter_summernote.dart';
import 'package:image_picker/image_picker.dart';
import 'package:provider/provider.dart';
import 'package:shared_preferences/shared_preferences.dart';
import 'package:xilancer/app_static_values.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/models/project_details_model.dart';
import 'package:xilancer/services/create_project_service.dart';
import 'package:xilancer/main.dart';
import 'package:xilancer/services/category_dropdown_service.dart';
import 'package:xilancer/views/onboarding_view/onboarding_view.dart';

import '../../models/category_model.dart';
import '../../models/packages_model.dart';

class CreateProjectViewModel {
  ValueNotifier<double> currentIndex = ValueNotifier(0);
  ValueNotifier<int> currentPackageIndex = ValueNotifier(0);
  TextEditingController skillController = TextEditingController();
  ValueNotifier<List<File>> projectImage = ValueNotifier([]);
  List<String> oldImages = [];
  ValueNotifier<List<String>> removedImages = ValueNotifier([]);
  dynamic id;
  ValueNotifier<bool> multiplePackages = ValueNotifier(false);
  ValueNotifier<List<SubCategory>> selectedSubcategories = ValueNotifier([]);
  ValueNotifier<Category?> selectedCategory = ValueNotifier(null);
  ValueNotifier<List<dynamic>> selectedServiceAreas = ValueNotifier([]);
  ValueNotifier<bool> isAllServiceAreasSelected = ValueNotifier(false);
  ValueNotifier<int> gigScore = ValueNotifier(0);
  TextEditingController videoUrlController = TextEditingController();

  final GlobalKey<FlutterSummernoteState> keyEditor =
      GlobalKey(debugLabel: DateTime.now().millisecondsSinceEpoch.toString());

  ValueNotifier<List<ExtraField>> extraFields = ValueNotifier([]);
  ValueNotifier<String> slugExample = ValueNotifier(siteLink);
  ValueNotifier<List<Package>> packages = ValueNotifier([
    Package(
        name: LocalKeys.basic,
        revision: 4,
        deliveryTime: jobLengths.first,
        regularPrice: 10,
        discountPrice: 9,
        extraFields: []),
    Package(
        name: LocalKeys.standard,
        revision: 4,
        deliveryTime: jobLengths.first,
        regularPrice: 10,
        discountPrice: 9,
        extraFields: []),
    Package(
        name: LocalKeys.premium,
        revision: 4,
        deliveryTime: jobLengths.first,
        regularPrice: 10,
        discountPrice: 9,
        extraFields: []),
  ]);

  TextEditingController titleController = TextEditingController();
  TextEditingController slugController = TextEditingController();
  TextEditingController descriptionController = TextEditingController();
  TextEditingController packageNameController = TextEditingController();
  TextEditingController regularPriceController = TextEditingController();
  TextEditingController discountPriceController = TextEditingController();
  List timelineList = [
    LocalKeys.projectIntro,
    LocalKeys.projectGalleryUpload,
    LocalKeys.projectPackagesAndCharge,
  ];
  List timelineDescriptions = [
    LocalKeys.projectIntroDesc,
    LocalKeys.projectGalleryUploadDesc,
    LocalKeys.projectPackagesAndChargeDesc,
  ];

  PageController pageController = PageController(initialPage: 0);

  final GlobalKey<FormState> introFormKey = GlobalKey();
  final GlobalKey<FormState> formKey = GlobalKey();

  ValueNotifier packageEditingIndex = ValueNotifier(0);
  ValueNotifier<bool> isLoading = ValueNotifier(false);

  CreateProjectViewModel._dispose();
  static bool get dispose {
    _instance = null;
    return true;
  }

  CreateProjectViewModel._init();
  static CreateProjectViewModel? _instance;
  static CreateProjectViewModel get instance {
    if (_instance == null) {
      _instance = CreateProjectViewModel._init();
      _instance!.loadDraft();
      _instance!.addListeners();
    }
    return _instance!;
  }

  void addListeners() {
    titleController.addListener(() {
      updateScoreAndDraft();
      if (id == null) {
        slugController.text = titleController.text.toSlug;
        slugExample.value = "$siteLink/${slugController.text}";
      }
    });
    slugController.addListener(updateScoreAndDraft);
    descriptionController.addListener(updateScoreAndDraft);
    videoUrlController.addListener(updateScoreAndDraft);
    selectedCategory.addListener(updateScoreAndDraft);
    selectedSubcategories.addListener(updateScoreAndDraft);
    projectImage.addListener(updateScoreAndDraft);
    packages.addListener(updateScoreAndDraft);
  }

  void updateScoreAndDraft() {
    calculateGigScore();
    saveToDrafts();
  }

  void calculateGigScore() {
    int score = 0;
    // Title: 20 pts (Min 40 chars)
    if (titleController.text.length >= 40) {
      score += 20;
    } else if (titleController.text.length >= 20) {
      score += 10;
    }

    // Description: 20 pts (Min 500 chars)
    if (descriptionController.text.length >= 500) {
      score += 20;
    } else if (descriptionController.text.length >= 200) {
      score += 10;
    }

    // Gallery: 20 pts (3+ images)
    int totalImages = (projectImage.value.length) + oldImages.length;
    if (totalImages >= 3) {
      score += 20;
    } else if (totalImages >= 1) {
      score += 10;
    }

    // Video: 20 pts
    if (videoUrlController.text.contains("youtube.com") ||
        videoUrlController.text.contains("youtu.be")) {
      score += 20;
    }

    // Packages: 20 pts
    bool packagesFilled = true;
    for (var p in packages.value) {
      if (p.regularPrice <= 0) packagesFilled = false;
    }
    if (packagesFilled) score += 10;

    // Service Areas: 10 pts
    if (isAllServiceAreasSelected.value || selectedServiceAreas.value.isNotEmpty) {
      score += 10;
    }

    gigScore.value = score;
  }

  Future<void> saveToDrafts() async {
    if (id != null) return; // Don't save drafts when editing existing
    final pref = await SharedPreferences.getInstance();
    await pref.setString('cp_title', titleController.text);
    await pref.setString('cp_desc', descriptionController.text);
    await pref.setString('cp_video', videoUrlController.text);
    if (selectedCategory.value != null) {
      await pref.setInt('cp_cat', selectedCategory.value!.id);
    }
    await pref.setBool('cp_is_all_areas', isAllServiceAreasSelected.value);
    await pref.setString('cp_areas', jsonEncode(selectedServiceAreas.value.map((e) => e.toJson()).toList()));
  }

  Future<void> loadDraft() async {
    final pref = await SharedPreferences.getInstance();
    if (id != null) return;
    titleController.text = pref.getString('cp_title') ?? "";
    descriptionController.text = pref.getString('cp_desc') ?? "";
    videoUrlController.text = pref.getString('cp_video') ?? "";
    isAllServiceAreasSelected.value = pref.getBool('cp_is_all_areas') ?? false;
    final areaString = pref.getString('cp_areas');
    if (areaString != null) {
      try {
        final List decoded = jsonDecode(areaString);
        selectedServiceAreas.value = decoded.map((e) => ServiceArea.fromJson(e)).toList();
      } catch (e) {
        debugPrint(e.toString());
      }
    }
    calculateGigScore();
  }

  void clearDraft() async {
    final pref = await SharedPreferences.getInstance();
    await pref.remove('cp_title');
    await pref.remove('cp_desc');
    await pref.remove('cp_video');
    await pref.remove('cp_cat');
    await pref.remove('cp_is_all_areas');
    await pref.remove('cp_areas');
  }

  bool get introValidate {
    if (introFormKey.currentState?.validate() != true) {
      return false;
    }
    if (selectedCategory.value == null) {
      LocalKeys.selectAState.showToast();
      return false;
    }
    if (selectedSubcategories.value.isEmpty) {
      LocalKeys.selectSubcategory.showToast();
      return false;
    }
    if (!isAllServiceAreasSelected.value && selectedServiceAreas.value.isEmpty) {
      LocalKeys.pleaseSelectServiceArea.showToast();
      return false;
    }
    return true;
  }

  bool get packagesValidate {
    bool isValid = true;
    for (var field in extraFields.value) {
      if (isValid) {
        isValid = field.name.isNotEmpty;
      }
    }
    return isValid;
  }

  void nextPage(BuildContext context) async {
    switch (currentIndex.value.round()) {
      case 0:
        debugPrint("waiting".toString());
        final etEditor = await keyEditor.currentState?.getText();
        debugPrint((etEditor).toString());
        if (etEditor == null) {
          return;
        }
        if (id == null) {
          descriptionController.text = etEditor;
        } else if ((etEditor).isNotEmpty) {
          descriptionController.text = etEditor;
        }
        debugPrint("$etEditor---________--------------");
        debugPrint("${descriptionController.text}===+++++++++++++++++");
        // Removed < 50 character length requirement
        if (introValidate) {
          await pageController.nextPage(
              duration: const Duration(milliseconds: 300),
              curve: Curves.easeIn);
          currentIndex.value = pageController.page ?? 0.0;
        } else {
          return;
        }
        break;
      case 1:
        await pageController.nextPage(
            duration: const Duration(milliseconds: 300), curve: Curves.easeIn);
        currentIndex.value = pageController.page ?? 0.0;
        break;
      case 2:
        if (!packagesValidate) {
          return;
        }
        isLoading.value = true;
        if (id == null) {
          await Provider.of<CreateProjectService>(context, listen: false)
              .tryCreatingProject()
              .then((v) {
            if (v == true) {
              clearDraft();
              LocalKeys.projectCreatedSuccessfully.showToast();
              context.toUntilPage(const OnboardingView());
            }
          });
        } else {
          await Provider.of<CreateProjectService>(context, listen: false)
              .tryEditingProject()
              .then((v) {
            if (v == true) {
              LocalKeys.projectCreatedSuccessfully.showToast();
              context.toUntilPage(const OnboardingView());
            }
          });
        }

        isLoading.value = false;
      default:
    }
  }

  List get packageAttributes {
    var attributes = {};

    return attributes.values.toList();
  }

  void goBack() async {
    await pageController.previousPage(
        duration: const Duration(milliseconds: 300), curve: Curves.easeIn);
    currentIndex.value = pageController.page ?? 0.0;
  }

  void selectImage() async {
    try {
      List<XFile> files = await ImagePicker().pickMultiImage(
        maxHeight: 1920,
        maxWidth: 1080,
      );
      if (files.isEmpty) {
        return;
      }
      projectImage.value = [
        ...projectImage.value,
        ...files.map((e) => File(e.path))
      ];
      LocalKeys.fileSelected.showToast();
    } catch (error) {
      LocalKeys.fileSelectFailed.showToast();
    }
  }

  void setSelectedSectionIndex(value) {
    currentIndex.value = value;
  }

  addPackage() {
    packages.value = [
      ...packages.value,
      Package(
          name: LocalKeys.package,
          revision: 1,
          deliveryTime: jobLengths.firstOrNull ?? "",
          regularPrice: 12,
          discountPrice: 32,
          extraFields: [])
    ];
  }

  addField({index}) {
    int id = DateTime.now().millisecondsSinceEpoch;
    extraFields.value = [
      ...extraFields.value,
      ExtraField(
        id: id,
        name: "${LocalKeys.title} ${extraFields.value.length}",
        type: FieldType.CHECK,
      )
    ];
  }

  removeField({index, id}) {
    extraFields.value.removeWhere((element) => element.id == id);
    extraFields.value = [...extraFields.value];
  }

  void setCurrentIndex(int index) {
    currentPackageIndex.value = index;
  }

  void changePackageDelTime(String? value) {}

  bool checkboxValue(ExtraField extraField) {
    switch (currentPackageIndex.value) {
      case 0:
        return extraField.basicValue == "on";
      case 1:
        return extraField.standardValue == "on";
      default:
        return extraField.premiumValue == "on";
    }
  }

  void setCheckBoxValue(ExtraField extraField, {value}) {
    int index = 0;
    index =
        extraFields.value.indexWhere((element) => element.id == extraField.id);
    switch (currentPackageIndex.value) {
      case 0:
        extraFields.value[index] =
            extraField.copyWith(basicValue: value.toString());
      case 1:
        extraFields.value[index] =
            extraField.copyWith(standardValue: value.toString());
      default:
        extraFields.value[index] =
            extraField.copyWith(premiumValue: value.toString());
    }
    debugPrint("value is $value".toString());
    extraFields.value = [...extraFields.value];
  }

  num quantityValue(ExtraField extraField) {
    switch (currentPackageIndex.value) {
      case 0:
        return extraField.basicValue.tryToParse;
      case 1:
        return extraField.standardValue.tryToParse;
      default:
        return extraField.premiumValue.tryToParse;
    }
  }

  void setQuantityValue(ExtraField extraField, {value}) {
    int index = 0;
    index =
        extraFields.value.indexWhere((element) => element.id == extraField.id);
    switch (currentPackageIndex.value) {
      case 0:
        extraFields.value[index] =
            extraField.copyWith(basicValue: value.toString());
      case 1:
        extraFields.value[index] =
            extraField.copyWith(standardValue: value.toString());
      default:
        extraFields.value[index] =
            extraField.copyWith(premiumValue: value.toString());
    }
    extraFields.value = [...extraFields.value];
  }

  void resetExtraFieldValues(ExtraField extraField) {
    int index = 0;
    index =
        extraFields.value.indexWhere((element) => element.id == extraField.id);
    final tempValue = extraFields.value[index];
    if (tempValue.type == FieldType.CHECK) {
      extraFields.value[index] = extraField.copyWith(
        basicValue: "on",
        standardValue: "on",
        premiumValue: "on",
      );
    } else {
      extraFields.value[index] = extraField.copyWith(
        basicValue: "0",
        standardValue: "0",
        premiumValue: "0",
      );
    }
    extraFields.value = [...extraFields.value];
  }

  initProject(ProjectDetails projectDetails) async {
    currentIndex.value = 0.0;
    extraFields.value.clear();
    selectedSubcategories.value.clear();
    id = projectDetails.id;
    packages.value[0] = Package(
        name: LocalKeys.basic,
        revision: projectDetails.basicRevision.toString().tryToParse,
        deliveryTime: projectDetails.basicDelivery ?? jobLengths.first,
        regularPrice: projectDetails.basicRegularCharge,
        discountPrice: projectDetails.basicDiscountCharge,
        extraFields: []);
    packages.value[1] = Package(
        name: LocalKeys.standard,
        revision: projectDetails.standardRevision.toString().tryToParse,
        deliveryTime: projectDetails.standardDelivery ?? jobLengths.first,
        regularPrice: projectDetails.standardRegularCharge,
        discountPrice: projectDetails.standardDiscountCharge,
        extraFields: []);
    packages.value[2] = Package(
        name: LocalKeys.premium,
        revision: projectDetails.premiumRevision.toString().tryToParse,
        deliveryTime: projectDetails.premiumDelivery ?? jobLengths.first,
        regularPrice: projectDetails.premiumRegularCharge,
        discountPrice: projectDetails.premiumDiscountCharge,
        extraFields: []);
    projectDetails.projectAttributes?.forEach((element) {
      extraFields.value.add(
        ExtraField(
          id: element.id,
          name: element.checkNumericTitle ?? "",
          type: element.type.toString() == "checkbox"
              ? FieldType.CHECK
              : FieldType.QUANTITY,
          basicValue: element.basicCheckNumeric ?? "on",
          standardValue: element.standardCheckNumeric ?? "on",
          premiumValue: element.premiumCheckNumeric ?? "on",
        ),
      );
    });
    titleController.text = projectDetails.title ?? "";
    slugController.text = projectDetails.slug ?? "";
    descriptionController.text = projectDetails.description ?? "";
    videoUrlController.text = projectDetails.videoUrl ?? "";
    keyEditor.currentState?.setText(projectDetails.description ?? "");

    selectedCategory.value = projectDetails.projectCategory;
    final context = navigatorKey.currentContext;
    if (projectDetails.categoryId != null && context != null) {
      try {
        final cdService =
            Provider.of<CategoryDropdownService>(context, listen: false);

        final match = cdService.getCategoryById(projectDetails.categoryId);
        if (match != null) {
          selectedCategory.value = match;
        } else {
          selectedCategory.value = Category(
            id: projectDetails.categoryId,
            name: projectDetails.projectCategory?.name ?? "...",
          );
          cdService.getCategory();
        }
      } catch (e) {
        debugPrint(e.toString());
        if (selectedCategory.value == null) {
          selectedCategory.value = Category(
            id: projectDetails.categoryId,
            name: "...",
          );
        }
      }
    }

    projectDetails.projectSubCategories?.forEach((element) {
      selectedSubcategories.value.add(element);
    });
    selectedServiceAreas.value = projectDetails.serviceAreas ?? [];
    isAllServiceAreasSelected.value =
        (projectDetails.serviceAreas ?? []).isEmpty;
    oldImages = projectDetails.images;
    multiplePackages.value =
        projectDetails.offerPackagesAvailableOrNot.toString().parseToBool;
  }
}

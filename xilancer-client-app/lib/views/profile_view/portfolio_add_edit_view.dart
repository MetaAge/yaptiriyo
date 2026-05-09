import 'dart:io';
import 'package:flutter/material.dart';
import 'package:image_picker/image_picker.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/helper/svg_assets.dart';
import 'package:xilancer/models/profile_details_model.dart';
import 'package:xilancer/services/portfolio_service.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/utils/components/field_with_label.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/helper/extension/string_extension.dart';

class PortfolioAddEditView extends StatefulWidget {
  final Portfolio? portfolio;
  const PortfolioAddEditView({super.key, this.portfolio});

  @override
  State<PortfolioAddEditView> createState() => _PortfolioAddEditViewState();
}

class _PortfolioAddEditViewState extends State<PortfolioAddEditView> {
  final _formKey = GlobalKey<FormState>();
  late TextEditingController _titleController;
  late TextEditingController _descriptionController;
  File? _image;
  bool _loading = false;

  @override
  void initState() {
    super.initState();
    _titleController = TextEditingController(text: widget.portfolio?.title);
    _descriptionController = TextEditingController(text: widget.portfolio?.description);
  }

  @override
  void dispose() {
    _titleController.dispose();
    _descriptionController.dispose();
    super.dispose();
  }

  Future<void> _pickImage() async {
    final picker = ImagePicker();
    final pickedFile = await picker.pickImage(source: ImageSource.gallery);
    if (pickedFile != null) {
      setState(() {
        _image = File(pickedFile.path);
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    final isEdit = widget.portfolio != null;
    return Scaffold(
      appBar: AppBar(
        leading: const NavigationPopIcon(),
        title: Text(isEdit ? LocalKeys.editPortfolio : LocalKeys.addNewPortfolio),
      ),
      body: SingleChildScrollView(
        padding: const EdgeInsets.all(20),
        child: Form(
          key: _formKey,
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              GestureDetector(
                onTap: _pickImage,
                child: Container(
                  height: 200,
                  width: double.infinity,
                  decoration: BoxDecoration(
                    color: context.dProvider.black9,
                    borderRadius: BorderRadius.circular(12),
                    border: Border.all(color: context.dProvider.black8),
                  ),
                  child: _image != null
                      ? ClipRRect(
                          borderRadius: BorderRadius.circular(12),
                          child: Image.file(_image!, fit: BoxFit.cover),
                        )
                      : widget.portfolio?.image != null
                          ? ClipRRect(
                              borderRadius: BorderRadius.circular(12),
                              child: Image.network(
                                widget.portfolio!.cloudImage ?? "${Provider.of<PortfolioService>(context, listen: false).portfolioPath}/${widget.portfolio!.image}",
                                fit: BoxFit.cover,
                              ),
                            )
                          : Column(
                              mainAxisAlignment: MainAxisAlignment.center,
                              children: [
                                SvgAssets.gallery.toSVGSized(40, color: context.dProvider.black5),
                                8.toHeight,
                                Text(LocalKeys.uploadImage, style: TextStyle(color: context.dProvider.black5)),
                              ],
                            ),
                ),
              ),
              20.toHeight,
              FieldWithLabel(
                label: LocalKeys.title,
                hintText: LocalKeys.enterTitle,
                controller: _titleController,
                validator: (value) {
                  if (value == null || value.isEmpty) return LocalKeys.enterTitle;
                  if (value.length < 5) return LocalKeys.titleTooShort;
                  return null;
                },
              ),
              FieldWithLabel(
                label: LocalKeys.description,
                hintText: LocalKeys.enterDescription,
                controller: _descriptionController,
                maxLines: 6,
                validator: (value) {
                  if (value == null || value.isEmpty) return LocalKeys.enterDescription;
                  if (value.length < 10) return LocalKeys.descriptionTooShort;
                  return null;
                },
              ),
              30.toHeight,
              CustomButton(
                onPressed: _submit,
                btText: isEdit ? LocalKeys.updatePortfolio : LocalKeys.addNewPortfolio,
                isLoading: _loading,
              ),
            ],
          ),
        ),
      ),
    );
  }

  Future<void> _submit() async {
    if (!_formKey.currentState!.validate()) return;
    if (widget.portfolio == null && _image == null) {
      LocalKeys.imageRequired.showToast();
      return;
    }

    setState(() => _loading = true);
    final ps = Provider.of<PortfolioService>(context, listen: false);
    bool success;
    if (widget.portfolio != null) {
      success = await ps.updatePortfolio(
        id: widget.portfolio!.id,
        title: _titleController.text,
        description: _descriptionController.text,
        image: _image,
      );
    } else {
      success = await ps.storePortfolio(
        title: _titleController.text,
        description: _descriptionController.text,
        image: _image!,
      );
    }

    if (success) {
      if (mounted) Navigator.pop(context);
    }
    if (mounted) setState(() => _loading = false);
  }
}

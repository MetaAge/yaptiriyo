import 'package:flutter/material.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/view_models/create_project_view_model/create_project_view_model.dart';

import '../../../helper/local_keys.g.dart';

class CreateProjectButtons extends StatelessWidget {
  final lastPage;
  const CreateProjectButtons({super.key, this.lastPage = false});

  @override
  Widget build(BuildContext context) {
    final cpv = CreateProjectViewModel.instance;
    return Row(
      children: [
        Expanded(
          flex: 16,
          child: OutlinedButton(
            onPressed: () {
              final cpv = CreateProjectViewModel.instance;
              cpv.goBack();
            },
            child: Text(LocalKeys.back),
          ),
        ),
        const Expanded(flex: 1, child: SizedBox()),
        Expanded(
          flex: 16,
          child: ValueListenableBuilder(
            valueListenable: cpv.isLoading,
            builder: (context, loading, child) {
              return CustomButton(
                onPressed: () async {
                  if (cpv.currentIndex.value == 0) {
                    final etEditor =
                        await cpv.keyEditor.currentState?.getText();
                    debugPrint((etEditor).toString());
                    if (etEditor == null) {
                      return;
                    }
                    if (cpv.id == null) {
                      cpv.descriptionController.text = etEditor;
                    } else if ((etEditor).isNotEmpty) {
                      cpv.descriptionController.text = etEditor;
                    }
                  }
                  cpv.nextPage(context);
                },
                btText: lastPage
                    ? (cpv.id != null
                        ? LocalKeys.editProject
                        : LocalKeys.createProject)
                    : LocalKeys.next,
                isLoading: loading,
              );
            },
          ),
        ),
      ],
    );
  }
}

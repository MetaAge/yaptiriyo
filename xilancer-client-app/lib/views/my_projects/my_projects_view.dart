import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/my_projects_service.dart';
import 'package:xilancer/utils/components/custom_future_widget.dart';
import 'package:xilancer/utils/components/custom_refresh_indicator.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/views/my_projects/components/project_list.dart';
import 'package:xilancer/views/my_projects/components/project_list_skeleton.dart';

import 'package:xilancer/views/create_project_view_freelancer/create_project_view.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import '../../view_models/create_project_view_model/create_project_view_model.dart';

class MyProjects extends StatelessWidget {
  static const routeName = "my_projects";
  const MyProjects({super.key});

  @override
  Widget build(BuildContext context) {
    final mpProvider = Provider.of<MyProjectsService>(context, listen: false);
    return Scaffold(
      appBar: AppBar(
        title: Text(LocalKeys.myProjects),
        actions: [
          IconButton(
            onPressed: () {
              CreateProjectViewModel.dispose;
              context.toNamed(CreateProjectView.routeName);
            },
            icon: const Icon(Icons.add, size: 28),
          ),
          const SizedBox(width: 8),
        ],
      ),
      floatingActionButton: FloatingActionButton(
        onPressed: () {
          CreateProjectViewModel.dispose;
          context.toNamed(CreateProjectView.routeName);
        },
        backgroundColor: context.dProvider.primaryColor,
        foregroundColor: context.dProvider.whiteColor,
        child: const Icon(Icons.add, size: 32),
      ),
      body: CustomRefreshIndicator(
        onRefresh: () async {
          await mpProvider.fetchMyProjects();
        },
        child: CustomFutureWidget(
          function:
              mpProvider.shouldAutoFetch ? mpProvider.fetchMyProjects() : null,
          shimmer: const ProjectListSkeleton(),
          child: const ProjectList(),
        ),
      ),
    );
  }
}

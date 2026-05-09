import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/services/bookmark_data_service.dart';
import 'package:xilancer/utils/components/empty_widget.dart';

import '../../customizations.dart';
import '../../helper/local_keys.g.dart';
import '../../models/project_list_model.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/views/bookmark_view/components/bookmark_card_horizontal.dart';

class BookmarkView extends StatelessWidget {
  const BookmarkView({super.key});

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        AppBar(
          leadingWidth: 0,
          leading: const SizedBox(),
          title: Text(LocalKeys.bookmark),
          backgroundColor: context.dProvider.whiteColor,
          elevation: 0,
        ),
        4.toHeight,
        Expanded(
          child: Consumer<BookmarkDataService>(builder: (context, bd, child) {
            return bd.bookmarkList.values.toList().isEmpty
                ? EmptyWidget(title: LocalKeys.noProjectsFound)
                : ListView.separated(
                    padding: const EdgeInsets.fromLTRB(20, 10, 20, 120),
                    itemBuilder: (context, index) {
                      final bItem = bd.bookmarkList.values.toList()[index];
                      final project = Project.fromJson(bItem);

                      return BookmarkCardHorizontal(
                        project: project,
                        projectsPath: projectAssetPath,
                      );
                    },
                    separatorBuilder: (context, index) => 12.toHeight,
                    itemCount: bd.bookmarkList.length);
          }),
        ),
      ],
    );
  }
}

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/job_list_service.dart.dart';
import 'package:xilancer/utils/components/custom_refresh_indicator.dart';
import 'package:xilancer/utils/components/empty_widget.dart';
import 'package:xilancer/views/my_jobs_view/components/job_card.dart';

import '../../utils/components/scrolling_preloader.dart';
import '../../view_models/home_view_model/home_view_model.dart';
import 'package:xilancer/views/home_view/components/job_card_skeleton.dart';

class JobsList extends StatelessWidget {
  const JobsList({super.key});

  @override
  Widget build(BuildContext context) {
    final hvm = HomeViewModel.instance;
    return CustomRefreshIndicator(
      onRefresh: () async {
        await Provider.of<JobListService>(context, listen: false)
            .fetchJobList(refreshing: true);
      },
      child: Consumer<JobListService>(builder: (context, jl, child) {
        if (jl.shouldAutoFetch) {
          WidgetsBinding.instance.addPostFrameCallback((_) {
            jl.fetchJobList();
          });
        }
        return ListView.separated(
            controller: hvm.scrollController,
            physics: const AlwaysScrollableScrollPhysics(),
            padding: const EdgeInsets.all(20),
            itemBuilder: (context, index) {
              if (jl.jobList == null) {
                return const JobCardSkeleton(fromDetails: false);
              }
              if (jl.jobList!.isEmpty) {
                return SizedBox(
                    height: context.height - (context.height / 3),
                    child: EmptyWidget(
                      title: LocalKeys.noJobFound,
                      physics: const NeverScrollableScrollPhysics(),
                      margin: EdgeInsets.zero,
                    ));
              }
              if ((jl.nextPage != null && !jl.nexLoadingFailed) &&
                  index == jl.jobList!.length) {
                return ScrollPreloader(loading: jl.nextPageLoading);
              }
              final jobItem = jl.jobList![index];
              return JobCard(
                id: jobItem.id,
                title: jobItem.title,
                createDate: jobItem.createdAt,
                expertise: jobItem.level.toString(),
                price: jobItem.budget,
                priceType: jobItem.type.toString(),
                proposalCount: jobItem.jobProposalCount ?? 0,
                jobStatus: jobItem.onOff.toString() == "1",
                isMine: false,
              );
            },
            separatorBuilder: (context, index) => 16.toHeight,
            itemCount: (jl.jobList?.length ?? 0) +
                ((jl.jobList?.length ?? 0) == 0 ? 1 : 0) +
                (jl.nextPage != null && !jl.nexLoadingFailed ? 1 : 0));
      }),
    );
  }
}

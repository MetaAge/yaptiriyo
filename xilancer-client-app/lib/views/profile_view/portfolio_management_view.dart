import 'package:flutter/material.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/helper/extension/int_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/portfolio_service.dart';
import 'package:xilancer/utils/components/custom_button.dart';
import 'package:xilancer/utils/components/navigation_pop_icon.dart';
import 'package:xilancer/views/profile_view/portfolio_add_edit_view.dart';
import 'package:xilancer/views/profile_details_view/components/portfolio_detail_bottom_sheet.dart';

class PortfolioManagementView extends StatefulWidget {
  static const routeName = 'portfolio_management_view';
  const PortfolioManagementView({super.key});

  @override
  State<PortfolioManagementView> createState() => _PortfolioManagementViewState();
}

class _PortfolioManagementViewState extends State<PortfolioManagementView> {
  @override
  void initState() {
    super.initState();
    WidgetsBinding.instance.addPostFrameCallback((_) {
      Provider.of<PortfolioService>(context, listen: false).fetchPortfolios();
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        leading: const NavigationPopIcon(),
        title: Text(LocalKeys.portfolio),
      ),
      body: Consumer<PortfolioService>(
        builder: (context, ps, child) {
          if (ps.isLoading && ps.portfolios.isEmpty) {
            return const Center(child: CircularProgressIndicator());
          }
          return ps.portfolios.isEmpty
              ? Center(
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Icon(Icons.folder_off_outlined, size: 60, color: context.dProvider.black8),
                      16.toHeight,
                      Text(LocalKeys.noResultFound, style: context.titleMedium?.copyWith(color: context.dProvider.black5)),
                    ],
                  ),
                )
              : ListView.separated(
                  padding: const EdgeInsets.all(20),
                  itemCount: ps.portfolios.length,
                  separatorBuilder: (context, index) => 16.toHeight,
                  itemBuilder: (context, index) {
                    final portfolio = ps.portfolios[index];
                    return Card(
                      elevation: 0,
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(12),
                        side: BorderSide(color: context.dProvider.black8),
                      ),
                      child: ListTile(
                        contentPadding: const EdgeInsets.all(12),
                        onTap: () {
                          showModalBottomSheet(
                            context: context,
                            isScrollControlled: true,
                            backgroundColor: Colors.transparent,
                            builder: (context) => PortfolioDetailBottomSheet(
                              portfolio: portfolio,
                              path: ps.portfolioPath ?? "",
                            ),
                          );
                        },
                        leading: ClipRRect(
                          borderRadius: BorderRadius.circular(8),
                          child: Image.network(
                            portfolio.cloudImage ?? "${ps.portfolioPath}/${portfolio.image}",
                            width: 60,
                            height: 60,
                            fit: BoxFit.cover,
                            errorBuilder: (context, error, stackTrace) => Container(
                              width: 60,
                              height: 60,
                              color: context.dProvider.black9,
                              child: const Icon(Icons.image_not_supported_outlined),
                            ),
                          ),
                        ),
                        title: Text(
                          portfolio.title ?? "",
                          style: context.titleMedium?.bold6,
                          maxLines: 1,
                          overflow: TextOverflow.ellipsis,
                        ),
                        subtitle: Text(
                          portfolio.description ?? "",
                          style: context.bodySmall,
                          maxLines: 2,
                          overflow: TextOverflow.ellipsis,
                        ),
                        trailing: Row(
                          mainAxisSize: MainAxisSize.min,
                          children: [
                            IconButton(
                              icon: const Icon(Icons.edit_outlined, size: 20),
                              onPressed: () {
                                Navigator.push(
                                  context,
                                  MaterialPageRoute(
                                    builder: (context) => PortfolioAddEditView(portfolio: portfolio),
                                  ),
                                );
                              },
                            ),
                            IconButton(
                              icon: Icon(Icons.delete_outline_rounded, size: 20, color: context.dProvider.warningColor),
                              onPressed: () {
                                _showDeleteConfirmation(context, ps, portfolio.id);
                              },
                            ),
                          ],
                        ),
                      ),
                    );
                  },
                );
        },
      ),
      bottomNavigationBar: Padding(
        padding: const EdgeInsets.all(20),
        child: CustomButton(
          onPressed: () {
            Navigator.push(
              context,
              MaterialPageRoute(
                builder: (context) => const PortfolioAddEditView(),
              ),
            );
          },
          btText: LocalKeys.addNewPortfolio,
          isLoading: false,
        ),
      ),
    );
  }

  void _showDeleteConfirmation(BuildContext context, PortfolioService ps, dynamic id) {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        title: Text(LocalKeys.areYouSure),
        content: Text(LocalKeys.deletePortfolioWarning),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: Text(LocalKeys.cancel),
          ),
          TextButton(
            onPressed: () async {
              Navigator.pop(context);
              await ps.deletePortfolio(id);
            },
            child: Text(LocalKeys.delete, style: TextStyle(color: context.dProvider.warningColor)),
          ),
        ],
      ),
    );
  }
}

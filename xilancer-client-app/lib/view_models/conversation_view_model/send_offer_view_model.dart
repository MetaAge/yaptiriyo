import 'dart:convert';

import 'package:flutter/material.dart';
import 'package:flutter_summernote/flutter_summernote.dart';
import 'package:provider/provider.dart';
import 'package:xilancer/helper/extension/string_extension.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/services/conversation_service.dart';
import 'package:xilancer/view_models/place_order_view_model/milestone_model.dart';

enum OfferPaymentType { single, milestone }

class SendOfferViewModel extends ChangeNotifier {
  OfferPaymentType paymentType = OfferPaymentType.single;

  TextEditingController priceController = TextEditingController();
  TextEditingController revisionController = TextEditingController();
  TextEditingController deadlineController = TextEditingController();
  final GlobalKey<FlutterSummernoteState> keyEditor = GlobalKey();

  // Milestone fields
  TextEditingController milestoneTitleController = TextEditingController();
  TextEditingController milestonePriceController = TextEditingController();
  TextEditingController milestoneRevisionController = TextEditingController();
  TextEditingController milestoneDeadlineController = TextEditingController();
  TextEditingController milestoneDescriptionController = TextEditingController();

  List<Milestone> milestones = [];

  ValueNotifier<bool> loading = ValueNotifier(false);

  void setPaymentType(OfferPaymentType type) {
    paymentType = type;
    notifyListeners();
  }

  void addMilestone() {
    if (milestoneTitleController.text.isEmpty ||
        milestonePriceController.text.isEmpty ||
        milestoneRevisionController.text.isEmpty ||
        milestoneDeadlineController.text.isEmpty) {
      LocalKeys.fillAllMilestoneFields.showToast();
      return;
    }
    milestones.add(Milestone(
      name: milestoneTitleController.text,
      price: double.tryParse(milestonePriceController.text) ?? 0,
      revision: int.tryParse(milestoneRevisionController.text) ?? 0,
      dTime: milestoneDeadlineController.text,
      description: milestoneDescriptionController.text,
    ));
    milestoneTitleController.clear();
    milestonePriceController.clear();
    milestoneRevisionController.clear();
    milestoneDeadlineController.clear();
    milestoneDescriptionController.clear();
    notifyListeners();
  }

  void removeMilestone(int index) {
    milestones.removeAt(index);
    notifyListeners();
  }

  double get totalMilestonePrice {
    return milestones.fold(0, (previousValue, element) => previousValue + element.price);
  }

  Future<void> submitOffer(BuildContext context, {required dynamic clientId}) async {
    final description = await keyEditor.currentState?.getText();
    if (priceController.text.isEmpty) {
      LocalKeys.offerPrice.showToast();
      return;
    }
    
    if (paymentType == OfferPaymentType.milestone) {
      if (milestones.isEmpty) {
        LocalKeys.addAtLeastOneMilestone.showToast();
        return;
      }
      if (totalMilestonePrice != (double.tryParse(priceController.text) ?? 0)) {
        LocalKeys.milestonePriceEqualOfferPrice.showToast();
        return;
      }
    } else {
      if (deadlineController.text.isEmpty) {
        LocalKeys.deliveryTime.showToast();
        return;
      }
    }

    loading.value = true;
    final cProvider = Provider.of<ConversationService>(context, listen: false);
    
    Map<String, String> body = {
      'client_id': clientId.toString(),
      'offer_price': priceController.text,
      'pay_at_once': paymentType == OfferPaymentType.single ? 'pay-at-once' : '',
      'pay_by_milestone': paymentType == OfferPaymentType.milestone ? 'pay-by-milestone' : '',
    };

    if (paymentType == OfferPaymentType.single) {
      body['offer_description'] = description!;
      body['offer_deadline'] = deadlineController.text;
      body['offer_revision'] = revisionController.text;
    } else {
      final milestoneData = milestones.map((e) => {
        'milestone_title': e.name,
        'milestone_description': e.description ?? "",
        'milestone_price': e.price.toString(),
        'milestone_revision': e.revision.toString(),
        'milestone_deadline': e.dTime,
      }).toList();
      body['milestones'] = jsonEncode(milestoneData);
    }

    final success = await cProvider.sendCustomOffer(body);
    loading.value = false;

    if (success) {
      Navigator.pop(context);
    }
  }
}

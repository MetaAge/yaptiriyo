// To parse this JSON data, do
//
//     final myProjectsModel = myProjectsModelFromJson(jsonString);

import 'dart:convert';

import 'package:xilancer/helper/extension/string_extension.dart';

MyProjectsModel myProjectsModelFromJson(String str) =>
    MyProjectsModel.fromJson(json.decode(str));

String myProjectsModelToJson(MyProjectsModel data) =>
    json.encode(data.toJson());

class MyProjectsModel {
  ProjectLists? projectLists;
  String? projectImagePath;

  MyProjectsModel({
    this.projectLists,
    this.projectImagePath,
  });

  factory MyProjectsModel.fromJson(json) => MyProjectsModel(
        projectLists: json["project_lists"] == null
            ? null
            : ProjectLists.fromJson(json["project_lists"]),
        projectImagePath: json["project_image_path"],
      );

  Map<String, dynamic> toJson() => {
        "project_lists": projectLists?.toJson(),
        "project_image_path": projectImagePath,
      };
}

class ProjectLists {
  int? currentPage;
  List<Project>? data;
  dynamic nextPageUrl;

  ProjectLists({
    this.currentPage,
    this.data,
    this.nextPageUrl,
  });

  factory ProjectLists.fromJson(Map<String, dynamic> json) => ProjectLists(
        data: json["data"] == null
            ? []
            : List<Project>.from(json["data"]!.map((x) => Project.fromJson(x))),
        nextPageUrl: json["next_page_url"],
      );

  Map<String, dynamic> toJson() => {
        "current_page": currentPage,
        "data": data == null
            ? []
            : List<dynamic>.from(data!.map((x) => x.toJson())),
        "next_page_url": nextPageUrl,
      };
}

class Project {
  dynamic id;
  dynamic userId;
  String? title;
  String? image;
  String? basicDelivery;
  num basicRegularCharge;
  String? status;
  num completeOrdersCount;
  num ratingsCount;
  num ratingsAvgRating;

  num? basicDiscountCharge;
  bool isPro;
  DateTime? proExpDate;
  final String? cloudImage;
  num? projectOnOff;
  bool isSubscriptionPromoted;
  bool isPremium;

  Project({
    this.id,
    this.userId,
    this.title,
    this.image,
    this.basicDelivery,
    required this.basicRegularCharge,
    required this.status,
    required this.basicDiscountCharge,
    required this.completeOrdersCount,
    required this.ratingsCount,
    required this.ratingsAvgRating,
    this.cloudImage,
    this.proExpDate,
    this.isPro = false,
    this.projectOnOff,
    this.isSubscriptionPromoted = false,
    this.isPremium = false,
  });

  factory Project.fromJson(Map<String, dynamic> json) => Project(
        id: json["id"],
        userId: json["user_id"],
        title: json["title"],
        image: json["image"] is List
            ? (json["image"] as List).isNotEmpty
                ? (json["image"] as List).first.toString()
                : null
            : json["image"]?.toString(),
        cloudImage: json["cloud_link"]?.toString(),
        basicDelivery: json["basic_delivery"],
        basicRegularCharge: json["basic_regular_charge"].toString().tryToParse,
        basicDiscountCharge:
            json["basic_discount_charge"]?.toString().tryToParse,
        status: json["status"].toString(),
        completeOrdersCount:
            json["complete_orders_count"].toString().tryToParse,
        ratingsCount: json["ratings_count"].toString().tryToParse,
        ratingsAvgRating: json["ratings_avg_rating"].toString().tryToParse,
        isPro: json["is_pro"].toString().parseToBool,
        proExpDate: DateTime.tryParse(json["pro_expire_date"].toString()),
        projectOnOff: json["project_on_off"].toString().tryToParse,
        isSubscriptionPromoted: json["is_subscription_promoted"].toString().parseToBool,
        isPremium: json["is_premium"].toString().parseToBool,
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "user_id": userId,
        "title": title,
        "image": image,
        "basic_regular_charge": basicRegularCharge,
        "status": status,
        "complete_orders_count": completeOrdersCount,
        "ratings_count": ratingsCount,
        "ratings_avg_rating": ratingsAvgRating,
        "is_subscription_promoted": isSubscriptionPromoted,
        "is_premium": isPremium,
      };
}

// To parse this JSON data, do
//
//     final promotionPackagesModel = promotionPackagesModelFromJson(jsonString);

import 'dart:convert';

import 'package:xilancer/helper/extension/string_extension.dart';

PromotionPackagesModel promotionPackagesModelFromJson(String str) =>
    PromotionPackagesModel.fromJson(json.decode(str));

String promotionPackagesModelToJson(PromotionPackagesModel data) =>
    json.encode(data.toJson());

class PromotionPackagesModel {
  final PackageLists? packageLists;

  PromotionPackagesModel({
    this.packageLists,
  });

  factory PromotionPackagesModel.fromJson(Map json) => PromotionPackagesModel(
        packageLists: json["package_lists"] == null
            ? null
            : PackageLists.fromJson(json["package_lists"]),
      );

  Map<String, dynamic> toJson() => {
        "package_lists": packageLists?.toJson(),
      };
}

class PackageLists {
  final List<PromotionPackages>? data;
  final dynamic nextPageUrl;

  PackageLists({
    this.data,
    this.nextPageUrl,
  });

  factory PackageLists.fromJson(Map<String, dynamic> json) => PackageLists(
        data: json["data"] == null
            ? []
            : List<PromotionPackages>.from(
                json["data"]!.map((x) => PromotionPackages.fromJson(x))),
        nextPageUrl: json["next_page_url"],
      );

  Map<String, dynamic> toJson() => {
        "data": data == null
            ? []
            : List<dynamic>.from(data!.map((x) => x.toJson())),
      };
}

class PromotionPackages {
  final dynamic id;
  final String? title;
  final num budget;
  final dynamic duration;

  PromotionPackages({
    this.id,
    this.title,
    this.budget = 0,
    this.duration,
  });

  factory PromotionPackages.fromJson(Map<String, dynamic> json) =>
      PromotionPackages(
        id: json["id"],
        title: json["title"],
        budget: json["budget"].toString().tryToParse,
        duration: json["duration"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "title": title,
        "budget": budget,
        "duration": duration,
      };
}

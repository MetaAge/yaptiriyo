import 'dart:convert';

ProfileInfoModel profileInfoModelFromJson(String str) =>
    ProfileInfoModel.fromJson(json.decode(str));

String profileInfoModelToJson(ProfileInfoModel data) =>
    json.encode(data.toJson());

class ProfileInfoModel {
  Data? data;

  ProfileInfoModel({this.data});

  factory ProfileInfoModel.fromJson(Map json) => ProfileInfoModel(
        data: json["data"] == null ? null : Data.fromJson(json["data"]),
      );

  Map<String, dynamic> toJson() => {"data": data?.toJson()};
}

class Data {
  dynamic id;
  String? firstName;
  String? lastName;
  String? email;
  dynamic country;
  dynamic countryId;
  dynamic state;
  dynamic stateId;
  dynamic city;
  dynamic cityId;
  String? experienceLevel;
  String? phone;
  String? image;
  final String? cloudImage;
  dynamic userType;
  String? username;
  UserIntroduction? userIntroduction;

  Data({
    this.id,
    this.firstName,
    this.lastName,
    this.email,
    this.country,
    this.countryId,
    this.state,
    this.stateId,
    this.city,
    this.cityId,
    this.experienceLevel,
    this.phone,
    this.image,
    this.cloudImage,
    this.userType,
    this.username,
    this.userIntroduction,
  });

  factory Data.fromJson(Map<String, dynamic> json) => Data(
        id: json["id"],
        firstName: json["first_name"],
        lastName: json["last_name"],
        email: json["email"],
        countryId: json["user_country"]?["id"] ?? json["country_id"],
        country: json["user_country"]?["country"] ?? json["country"],
        stateId: json["user_state"]?["id"] ?? json["state_id"],
        state: json["user_state"]?["state"] ?? json["state"],
        city: json["user_city"]?["city"] ?? json["city"],
        cityId: json["user_city"]?["id"] ?? json["city_id"],
        experienceLevel: json["experience_level"],
        phone: json["phone"],
        image: json["image"],
        cloudImage: json["freelancer_cloud_image"],
        userType: json["user_type"],
        username: json["username"],
        userIntroduction: (json["user_introduction"] != null)
            ? UserIntroduction.fromJson(json["user_introduction"])
            : (json["introduction"] != null)
                ? UserIntroduction.fromJson(json["introduction"])
                : (json["freelancer_introduction"] != null)
                    ? UserIntroduction.fromJson(json["freelancer_introduction"])
                    : (json["title"] != null ||
                            json["description"] != null ||
                            json["about"] != null)
                        ? UserIntroduction(
                            title: json["title"] ?? json["professional_title"],
                            description:
                                json["description"] ?? json["about"] ?? json["bio"])
                        : null,
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "first_name": firstName,
        "last_name": lastName,
        "email": email,
        "country": country,
        "country_id": countryId,
        "state": state,
        "state_id": stateId,
        "city": city,
        "city_id": cityId,
        "experience_level": experienceLevel,
        "phone": phone,
        "image": image,
        "user_introduction": userIntroduction?.toJson(),
      };
}

class UserIntroduction {
  dynamic id;
  dynamic userId;
  String? title;
  String? description;

  UserIntroduction({
    this.id,
    this.userId,
    this.title,
    this.description,
  });

  factory UserIntroduction.fromJson(Map<String, dynamic> json) =>
      UserIntroduction(
        id: json["id"],
        userId: json["user_id"],
        title: json["title"],
        description: json["description"] ?? json["about"] ?? json["bio"],
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "user_id": userId,
        "title": title,
        "description": description,
      };
}

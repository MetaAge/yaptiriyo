import 'dart:convert';

UserAddressModel userAddressModelFromJson(String str) => UserAddressModel.fromJson(json.decode(str));

String userAddressModelToJson(UserAddressModel data) => json.encode(data.toJson());

class UserAddressModel {
  List<UserAddress>? addresses;

  UserAddressModel({
    this.addresses,
  });

  factory UserAddressModel.fromJson(Map<String, dynamic> json) => UserAddressModel(
        addresses: json["addresses"] == null
            ? []
            : List<UserAddress>.from(json["addresses"].map((x) => UserAddress.fromJson(x))),
      );

  Map<String, dynamic> toJson() => {
        "addresses": addresses == null ? [] : List<dynamic>.from(addresses!.map((x) => x.toJson())),
      };
}

class UserAddress {
  dynamic id;
  dynamic userId;
  String? name;
  String? addressDetails;
  dynamic countryId;
  dynamic stateId;
  dynamic cityId;
  String? zipCode;
  String? phone;
  bool? isDefault;
  Country? country;
  State? state;
  City? city;

  UserAddress({
    this.id,
    this.userId,
    this.name,
    this.addressDetails,
    this.countryId,
    this.stateId,
    this.cityId,
    this.zipCode,
    this.phone,
    this.isDefault,
    this.country,
    this.state,
    this.city,
  });

  factory UserAddress.fromJson(Map<String, dynamic> json) => UserAddress(
        id: json["id"],
        userId: json["user_id"],
        name: json["name"]?.toString(),
        addressDetails: json["address_details"]?.toString(),
        countryId: json["country_id"],
        stateId: json["state_id"],
        cityId: json["city_id"],
        zipCode: json["zip_code"]?.toString(),
        phone: json["phone"]?.toString(),
        isDefault: json["is_default"] == 1 || json["is_default"] == true,
        country: json["country"] == null ? null : Country.fromJson(json["country"]),
        state: json["state"] == null ? null : State.fromJson(json["state"]),
        city: json["city"] == null ? null : City.fromJson(json["city"]),
      );

  Map<String, dynamic> toJson() => {
        "id": id,
        "user_id": userId,
        "name": name,
        "address_details": addressDetails,
        "country_id": countryId,
        "state_id": stateId,
        "city_id": cityId,
        "zip_code": zipCode,
        "phone": phone,
        "is_default": isDefault,
      };
}

class Country {
  dynamic id;
  String? name;

  Country({
    this.id,
    this.name,
  });

  factory Country.fromJson(Map<String, dynamic> json) => Country(
        id: json["id"],
        name: json["name"] ?? json["country"],
      );
}

class State {
  dynamic id;
  String? name;

  State({
    this.id,
    this.name,
  });

  factory State.fromJson(Map<String, dynamic> json) => State(
        id: json["id"],
        name: json["name"] ?? json["state"],
      );
}

class City {
  dynamic id;
  String? name;

  City({
    this.id,
    this.name,
  });

  factory City.fromJson(Map<String, dynamic> json) => City(
        id: json["id"],
        name: json["name"] ?? json["city"],
      );
}

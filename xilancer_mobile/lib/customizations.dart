import 'dart:io';

import 'package:flutter/material.dart';

String siteLink = 'http://127.0.0.1:8000';

String appLabel = 'Xilancer';
String storeLabel = "Xilancer";
String appVersion = '1.0.0';

String wPaymentUpdateEncryptionKey = 'apiwalletkey';
String promotionPaymentUpdateEncryptionKey = 'apipkey';
String socialSignInKey =
    '\$2y\$10\$GlEhJtlTAqv2rvQd2llgPeGGV8RT2Yap844OSazHfHlbU.0bvVTPm';

//This is only needed for apple sign-in.
String clientSecret = "";
final googleClientIdForIOS =
    Platform.isIOS
        ? "479882132969-9i9aqik3jfjd7qhci1nqf0bm2g71rm1u.apps.googleusercontent.com"
        : null;

String get baseEndPoint => "$siteLink/api/v1/freelancer";
String get projectImagePath => "$siteLink/assets/uploads/project";

const Color primaryColor = Color(0xff6176F6);
const Color blackColor = Color(0xff101828);
const Color whiteColor = Color(0xffffffff);
const Color hintColor = Color(0xff9a9a9e);
const Color borderColor = Color(0xffCDCCCE);
const Color secondaryColor = Color(0xff6176F6);
const Color warningColor = Color(0xffEB4747);
const Color greenColor = Color(0xff65C18C);
const Color yellowColor = Color(0xffFFB200);

const Color proTagColor = Color.fromARGB(255, 88, 15, 119);
const Color gOneColor = Color(0xff6176F6);
const gTwoColor = Color(0xffFAA500);

List<Color> get chatAvatarBGColors => [
  const Color(0xff0087BF),
  const Color(0xff5A8770),
  const Color(0xff9A89B5),
  const Color(0xffF5888D),
  const Color(0xff98A2B3),
  const Color(0xffF18636),
];
List<Color> get statusColors => [
  const Color(0xff9a9a9e),
  const Color(0xff65C18C),
  const Color(0xffEB4747),
];

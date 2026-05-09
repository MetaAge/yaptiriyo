import 'dart:convert';
import 'package:intl/intl.dart';

import 'package:crypto/crypto.dart';
import 'package:flutter/material.dart';
import 'package:flutter_svg/svg.dart';
import 'package:fluttertoast/fluttertoast.dart';
import 'package:xilancer/customizations.dart';
import 'package:xilancer/helper/local_keys.g.dart';
import 'package:xilancer/helper/extension/context_extension.dart';
import 'package:xilancer/main.dart';
import '../constant_helper.dart';

extension SvgPathExtension on String {
  Widget get toSVG => SvgPicture.asset('assets/svg/$this.svg');
}

extension SvgSizedExtension on String {
  Widget toSVGSized(double height, {color}) => SvgPicture.asset(
        'assets/svg/$this.svg',
        height: height,
        color: color,
      );
}

extension StringExtension on String {
  String get capitalize {
    if (isEmpty) return this;
    final laterPart = substring(1);
    return "${this[0].toUpperCase()}${laterPart.toLowerCase()}";
  }

  num get tryToParse {
    RegExp numberPattern = RegExp(r'\d+(\.\d+)?');

    // Replace all matches with an empty string
    String originalCurrency = replaceAll(",", "").replaceAll(numberPattern, '');
    return num.tryParse(replaceAll(originalCurrency, "")
            .replaceAll(",", "")
            .replaceAll(dProvider.currencySymbol.toString(), "")) ??
        0;
  }

  bool get parseToBool {
    return this == "true" || this == "1" || this == "yes";
  }

  String get toSlug {
    return toLowerCase()
        .replaceAll('ş', 's')
        .replaceAll('ğ', 'g')
        .replaceAll('ç', 'c')
        .replaceAll('ı', 'i')
        .replaceAll('ö', 'o')
        .replaceAll('ü', 'u')
        .replaceAll(RegExp(r'[^\w\s-]'), '')
        .trim()
        .replaceAll(RegExp(r'\s+'), '-');
  }
}

extension NumConversionExtension on Object {
  num get tryToParse {
    RegExp numberPattern = RegExp(r'\d+(\.\d+)?');
    final objString = toString();
    // Replace all matches with an empty string
    String originalCurrency =
        objString.replaceAll(",", "").replaceAll(numberPattern, '');
    return num.tryParse(objString
            .replaceAll(originalCurrency, "")
            .replaceAll(",", "")
            .replaceAll(dProvider.currencySymbol.toString(), "")) ??
        0;
  }
}

extension NumConversionExtensionD on dynamic {
  num get tryToParse {
    RegExp numberPattern = RegExp(r'\d+(\.\d+)?');
    final objString = toString();
    // Replace all matches with an empty string
    String originalCurrency =
        objString.replaceAll(",", "").replaceAll(numberPattern, '');
    return num.tryParse(objString
            .replaceAll(originalCurrency, "")
            .replaceAll(",", "")
            .replaceAll(dProvider.currencySymbol.toString(), "")) ??
        0;
  }
}

extension CurrencyDynamicExtension on String {
  String get cur {
    String symbol = dProvider.currencySymbol;
    String formatted = this;
    try {
      double? value = double.tryParse(this);
      if (value != null) {
        final formatter = NumberFormat.currency(locale: 'tr_TR', symbol: '');
        formatted = formatter.format(value).trim();
      }
    } catch (e) {}
    return dProvider.currencyRight ? "$formatted$symbol" : "$symbol$formatted";
  }
}

extension TranslateExtension on String {
  String tr() {
    return asProvider.getString(this);
  }
}

extension EmailValidateExtension on String {
  bool get validateEmail {
    final emailReg = RegExp(
        r"^[a-zA-Z0-9.a-zA-Z0-9.!#$%&'*+-/=?^_`{|}~]+@[a-zA-Z0-9]+\.[a-zA-Z]+");
    return emailReg.hasMatch(this);
  }
}

extension ShowToastExtension on String {
  showToast({bc, tc}) {
    final context = navigatorKey.currentContext;
    if (context == null) return;
    
    final message = asProvider.getString(this);
    ScaffoldMessenger.of(context).removeCurrentSnackBar();
    ScaffoldMessenger.of(context).showSnackBar(
      SnackBar(
        content: Row(
          children: [
            Icon(Icons.info_outline, color: dProvider.primaryColor, size: 20),
            const SizedBox(width: 12),
            Expanded(
              child: Text(
                message,
                style: context.titleSmall?.copyWith(
                  color: tc ?? (bc == null ? Colors.black87 : Colors.white),
                  fontSize: 14,
                  fontWeight: FontWeight.w600,
                ),
              ),
            ),
          ],
        ),
        backgroundColor: bc ?? Colors.white,
        behavior: SnackBarBehavior.floating,
        margin: const EdgeInsets.fromLTRB(16, 0, 16, 24),
        padding: const EdgeInsets.symmetric(horizontal: 16, vertical: 14),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(16),
          side: BorderSide(color: bc == null ? dProvider.black8 : Colors.transparent, width: 0.5),
        ),
        elevation: 8,
        duration: const Duration(seconds: 3),
      ),
    );
  }
}

extension CapitalizeWordsExtension on String {
  String get capitalizeWords {
    if (isEmpty) {
      return '';
    }

    List<String> words = split(' ');
    List<String> capitalizedWords = [];

    for (String word in words) {
      if (word.isNotEmpty) {
        String capitalized = word[0].toUpperCase() + word.substring(1);
        capitalizedWords.add(capitalized);
      }
    }

    return capitalizedWords.join(' ');
  }
}

extension TokenValidateExtension on String {
  bool get isInvalid {
    return this != getToken;
  }
}

extension OrderStatusExtension on String {
  String get getStatus {
    switch (this) {
      case "0":
        return LocalKeys.pendingOrder;
      case "1":
        return LocalKeys.activeOrder;
      case "2":
        return LocalKeys.orderDelivered;
      case "3":
        return LocalKeys.completeOrder;
      case "4":
        return LocalKeys.canceledOrder;
      case "5":
        return LocalKeys.orderDeclined;
      case "6":
        return LocalKeys.orderSuspended;
      case "7":
        return LocalKeys.orderOnHold;
      default:
        return LocalKeys.pending;
    }
  }
}

extension MilestoneStatusExtension on String {
  String get getMStatus {
    switch (this) {
      case "0":
        return LocalKeys.pending;

      case "1":
        return LocalKeys.active;
      case "2":
        return LocalKeys.complete;
      case "3":
        return LocalKeys.cancel;
      case "4":
        return LocalKeys.delivered;
      default:
        return LocalKeys.pending;
    }
  }
}

extension WSHistoryStatusExtension on String {
  String get getWSHStatus {
    switch (this) {
      case "0":
        return LocalKeys.pending;
      case "1":
        return LocalKeys.approved;
      case "2":
        return LocalKeys.requestedRevision;
      default:
        return LocalKeys.pending;
    }
  }
}

extension WalletStatusExtension on String {
  String get getWalletStatus {
    switch (toLowerCase()) {
      case "pending":
        return LocalKeys.pending;
      case "complete":
      case "completed":
      case "success":
        return LocalKeys.complete;
      case "cancel":
      case "canceled":
      case "cancelled":
        return LocalKeys.canceled;
      default:
        return capitalize;
    }
  }
}

extension PasswordValidatorExtension on String {
  String? get validPass {
    String? value;
    if (length < 8) {
      value = LocalKeys.passLeastCharWarning.tr();
    } else if (!RegExp(r'[A-Z]').hasMatch(this)) {
      value = LocalKeys.passUpperCaseWarning.tr();
    } else if (!RegExp(r'[a-z]').hasMatch(this)) {
      value = LocalKeys.passLowerCaseWarning.tr();
    } else if (!RegExp(r'\d').hasMatch(this)) {
      value = LocalKeys.passDigitWarning.tr();
    } else if (!RegExp(r'[@$!%*?&]').hasMatch(this)) {
      value = LocalKeys.passCharacterWarning.tr();
    }
    debugPrint(value.toString());
    return value;
  }
}

extension AssetExtension on String {
  Widget toAImage({color, fit}) => Image.asset(
        'assets/images/$this.png',
        fit: fit,
      );
  String get profileImage => "$userProfilePath/$this";
  String get jobProposalAttachment => "$jobProposalAssetPath/$this";
}

extension AssetImageExtension on String {
  ImageProvider get toAsset => AssetImage(
        'assets/images/$this.png',
      );
}

extension EncryptionExtension on String {
  String toHmac({required String secret}) {
    final keyBytes = const Utf8Encoder().convert(secret);
    final dataBytes = const Utf8Encoder().convert(this);

    final hmacBytes = Hmac(sha256, keyBytes).convert(dataBytes);
    return hmacBytes.toString();
  }
}

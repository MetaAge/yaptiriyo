class SavedCard {
  final String cardToken;
  final String cardUserKey;
  final String? lastFourDigits;
  final String? cardAlias;
  final String? cardAssociation;
  final String? cardFamily;
  final String? cardBankName;

  SavedCard({
    required this.cardToken,
    required this.cardUserKey,
    this.lastFourDigits,
    this.cardAlias,
    this.cardAssociation,
    this.cardFamily,
    this.cardBankName,
  });

  factory SavedCard.fromJson(Map<String, dynamic> json) {
    return SavedCard(
      cardToken: json['card_token'] ?? '',
      cardUserKey: json['card_user_key'] ?? '',
      lastFourDigits: json['last_four_digits'],
      cardAlias: json['card_alias'],
      cardAssociation: json['card_association'],
      cardFamily: json['card_family'],
      cardBankName: json['card_bank_name'],
    );
  }
}

import 'package:xilancer/services/user_mode_service.dart';

import '/customizations.dart';

class AppUrls {
  static String get baseUrl => siteLink;
  static String get _base => UserModeService.instance.baseApiUrl;
  static String get _baseDiscovery => baseClientEndPoint;

  static String get countryUrl => '$_baseDiscovery/country/all';
  static String get signInUrl => '$_base/login';
  static String get signUpUrl => '$_base/register';
  static String get emailVerifyUrl => '$_base/email-verify';
  static String get cityUrl => '$_baseDiscovery/city/all';
  static String get stateUrl => '$_baseDiscovery/state/all';
  static String get profileInfoUrl => '$_base/personal/info';
  static String get changePasswordUrl => '$_base/profile/password/update';
  static String get sendOtpUrl => '$_base/resend-otp';
  static String get resetPasswordUrl => '$_base/reset-password';
  static String get signOutUrl => '$_base/logout';
  static String get deleteAccountUrl => '$_base/account/delete';
  static String get profileInfoUpdate => '$_base/personal/info/update';
  static String get profileImageUpdate => '$_base/profile/image/update';
  static String get myOrdersListUrl => '$_base/order/all';
  static String get orderDetailsUrl => '$_base/order/details';
  static String get jobListUrl => '$_baseDiscovery/job/all';
  static String get jobDetailsUrl => '$_baseDiscovery/job/details';
  static String get profileDetailsUrl => '$_baseDiscovery/profile/details';
  static String get createTicketUrl => '$_base/ticket/create';
  static String get ticketListUrl => '$_base/ticket/all';
  static String get stListUrl => '$_base/ticket/single/all-message';
  static String get stDepartmentsUrl => '$_base/department/all';
  static String get fetchTicketChatUrl => '$_base/ticket/details';
  static String get sendTicketMessageUrl => '$_base/ticket/message-send';
  static String get notificationsListUrl => '$_base/notification/unread';
  static String get walletHistoryUrl => '$_base/wallet/history';
  static String get chatListUrl =>
      UserModeService.instance.isFreelancer
          ? '$_base/chat/client-list'
          : '$_base/chat/freelancer-list';
  static String get conversationUrl => '$_base/chat/fetch-record';
  static String get messageSendUrl =>
      UserModeService.instance.isFreelancer
          ? '$_base/chat/message-send?client'
          : '$_base/chat/message-send';
  static String get categoryUrl => '$_baseDiscovery/category/all';
  static String get skillUrl => '$_baseDiscovery/skill/all';
  // static String jobFilter = '$baseEndPoint/job/filter';
  static String get chatCredentialUrl => '$_base/chat/credentials';
  static String get moduleListUrl => '$_base/module/module-status';
  static String get currencyLanguageUrl => '$_baseDiscovery/language/all';
  static String get translationUrl => '$_baseDiscovery/language/string-translate';
  static String get nCountUrl => '$_base/notification/unread/count';
  static String get mCountUrl => '$_base/chat/unseen-message/count';
  static String get updateNotificationUrl => '$_base/notification/read';
  static String get myOffersUrl =>
      UserModeService.instance.isFreelancer
          ? '$_base/job/my-offers'
          : '$_base/offer/all';
  static String get offerDetailsUrl => '$_base/offer/details';
  static String get fcmTokenUrl => '$_base/update/token';
  static String get projectFilterUrl => '$_baseDiscovery/projects/all/filter';
  static String get projectDetailsUrl => '$_baseDiscovery/project/details';
  static String get paymentGatewayUrl => '$baseEndPoint/gateway/list';
  static String get createJobUrl => '$_base/job/create';
  static String get editJobUrl => '$_base/job/edit';
  static String get placeOrderUrl => '$_base/order/confirm-order';
  static String get updatePaymentUrl => '$_base/order/payment-update';
  static String get acceptOrderUrl => '$_base/order/approve/milestone';
  static String get shortlistToggleUrl =>
      '$_base/job/proposal/add-to-shortlist';
  static String get requestRevisionUrl =>
      '$_base/order/request-revision/for/order/or/milestone';
  static String get proposalRejectUrl => '$_base/job/proposal/reject';
  static String get jobStatusToggleUrl => '$_base/job/open/close';
  static String get walletDepositUrl => '$_base/wallet/deposit';
  static String get updateDepositPaymentUrl => '$_base/wallet/deposit/update-payment';
  
  // Iyzico specific URLs
  static String get iyzicoCardsUrl => '$_base/iyzico/cards';
  static String get iyzicoSaveCardUrl => '$_base/iyzico/card/save';
  static String get iyzicoDeleteCardUrl => '$_base/iyzico/card/delete';
  static String get iyzico3dsCompleteUrl => '$_base/iyzico/3ds-complete';

  // Freelancer Specific URLs
  static String get myProposalsUrl => '$_base/job/my-proposals';
  static String get myProjectsUrl => '$_base/project/list';
  static String get withdrawHistoryUrl => '$_base/withdraw/history';
  static String get withdrawRequestUrl => '$_base/withdraw/request';
  static String get subscriptionListUrl => '$_base/subscription/list';
  static String get subscriptionHistoryUrl => '$_base/subscription/history/list';
  static String get subsBuyUrl => '$_base/subscription/buy';
  static String get subsValidateIapUrl => '$_base/subscription/validate-iap';

  // Additional Freelancer Specific URLs
  static String get promoteUrl => '$_base/promotion/package/buy';
  static String get updatePromotionPaymentUrl => '$_base/promotion/package/update-payment';
  static String get promotionPackagesUrl => '$_base/promotion/package/list';
  static String get sendJobOffer => '$_base/job/proposal-send';
  static String get orderAcceptUrl => '$_base/order/accept';
  static String get orderCancelUrl => '$_base/order/decline';
  static String get submitWorkUrl => '$_base/order/submit';
  static String get createProjectUrl => '$_base/project/create';
  static String get editProjectUrl => '$_base/project/update';
  static String get fetchProjectDetailsUrl => '$_base/project/details';
  static String get withdrawSettingsUrl => '$_base/withdraw/settings';
  static String get subscriptionTypeListUrl => '$_base/subscription/types';
  static String get updateSubsPaymentUrl => '$_base/subscription/buy/update-payment';
  static String get sendCustomOfferUrl => '$_base/offer/send';
  static String get offerRejectUrl => '$_base/offer/reject';
  static String get projectStatusChangeUrl => '$_base/project/availability';
  static String get projectDeleteUrl => '$_base/project/delete';
  static String get profileStatusChangeUrl => '$_base/project/user-work-availability-status';
  static String get projectSubscriptionPromoteToggleUrl => '$_base/project/subscription-promote-toggle';
  static String get submitRatingUrl => '$_base/order/rating';


  // Agora Voice Call URLs
  static String get agoraTokenUrl => '$_base/agora/token';
  static String get agoraInitiateCallUrl => '$_base/agora/call/initiate';
  static String get agoraAcceptCallUrl => '$_base/agora/call/accept';
  static String get agoraEndCallUrl => '$_base/agora/call/end';
  static String get agoraDeclineCallUrl => '$_base/agora/call/decline';
  static String get agoraCallHistoryUrl => '$_base/agora/call/history';

  // User Address URLs
  static String get userAddressesUrl => '$baseClientEndPoint/addresses';
  static String get userAddressStoreUrl => '$baseClientEndPoint/addresses/store';
  static String get userAddressUpdateUrl => '$baseClientEndPoint/addresses/update';
  static String get userAddressDeleteUrl => '$baseClientEndPoint/addresses/delete';
  static String get userAddressMakeDefaultUrl => '$baseClientEndPoint/addresses/make-default';

  // Portfolio URLs
  static String get portfolioListUrl => '$_base/portfolio/list';
  static String get portfolioStoreUrl => '$_base/portfolio/store';
  static String get portfolioUpdateUrl => '$_base/portfolio/update';
  static String get portfolioDeleteUrl => '$_base/portfolio/delete';
}

<?php

namespace App\Http\Services\Frontend;

use Iyzipay\Model\Address;
use Iyzipay\Model\BasketItem;
use Iyzipay\Model\BasketItemType;
use Iyzipay\Model\Buyer;
use Iyzipay\Model\Card;
use Iyzipay\Model\CardInformation;
use Iyzipay\Model\CardList;
use Iyzipay\Model\Currency;
use Iyzipay\Model\Locale;
use Iyzipay\Model\Payment;
use Iyzipay\Model\PaymentCard;
use Iyzipay\Model\PaymentChannel;
use Iyzipay\Model\PaymentGroup;
use Iyzipay\Model\ThreedsInitialize;
use Iyzipay\Model\ThreedsPayment;
use Iyzipay\Options;
use Iyzipay\Request\CreateCardRequest;
use Iyzipay\Request\CreatePaymentRequest;
use Iyzipay\Request\CreateThreedsPaymentRequest;
use Iyzipay\Request\DeleteCardRequest;
use Iyzipay\Request\RetrieveCardListRequest;

class IyzicoPaymentService
{
    private Options $options;

    public function __construct()
    {
        $this->options = new Options();
        $this->options->setApiKey(get_static_option('iyzipay_api_key'));
        $this->options->setSecretKey(get_static_option('iyzipay_secret_key'));

        $testMode = get_static_option('iyzipay_test_mode');
        if ($testMode === 'on') {
            $this->options->setBaseUrl('https://sandbox-api.iyzipay.com');
        } else {
            $this->options->setBaseUrl('https://api.iyzipay.com');
        }
    }

    /**
     * Initialize a 3DS payment
     */
    public function initialize3DS($order, $user, $cardData, $callbackUrl)
    {
        $request = $this->buildPaymentRequest($order, $user, $cardData);
        $request->setCallbackUrl($callbackUrl);

        $threedsInitialize = ThreedsInitialize::create($request, $this->options);

        return $threedsInitialize;
    }

    /**
     * Complete 3DS payment after callback
     */
    public function complete3DS($paymentId)
    {
        $request = new CreateThreedsPaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId(uniqid('3ds_'));
        $request->setPaymentId($paymentId);

        $threedsPayment = ThreedsPayment::create($request, $this->options);

        return $threedsPayment;
    }

    /**
     * Process a non-3DS payment (fallback)
     */
    public function processPayment($order, $user, $cardData)
    {
        $request = $this->buildPaymentRequest($order, $user, $cardData);

        $payment = Payment::create($request, $this->options);

        return $payment;
    }

    /**
     * Save a card for the user
     */
    public function saveCard($user, $cardData)
    {
        $cardInformation = new CardInformation();
        $cardInformation->setCardAlias($cardData['card_alias'] ?? 'Kartım');
        $cardInformation->setCardHolderName($cardData['card_holder_name']);
        $cardInformation->setCardNumber($cardData['card_number']);
        $cardInformation->setExpireMonth($cardData['expire_month']);
        $cardInformation->setExpireYear($cardData['expire_year']);

        $request = new CreateCardRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId(uniqid('card_'));
        $request->setEmail($user->email);
        $request->setCard($cardInformation);

        // If user already has a cardUserKey, use it
        if (!empty($user->iyzico_card_user_key)) {
            $request->setCardUserKey($user->iyzico_card_user_key);
        } else {
            $request->setExternalId($user->id);
        }

        $card = Card::create($request, $this->options);

        // Save cardUserKey to user if new
        if ($card->getStatus() === 'success' && !empty($card->getCardUserKey())) {
            $user->update(['iyzico_card_user_key' => $card->getCardUserKey()]);
        }

        return $card;
    }

    /**
     * Get saved cards for a user
     */
    public function getCards($user)
    {
        if (empty($user->iyzico_card_user_key)) {
            return null;
        }

        $request = new RetrieveCardListRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId(uniqid('list_'));
        $request->setCardUserKey($user->iyzico_card_user_key);

        $cardList = CardList::retrieve($request, $this->options);

        return $cardList;
    }

    /**
     * Delete a saved card
     */
    public function deleteCard($user, $cardToken)
    {
        if (empty($user->iyzico_card_user_key)) {
            return null;
        }

        $request = new DeleteCardRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId(uniqid('del_'));
        $request->setCardUserKey($user->iyzico_card_user_key);
        $request->setCardToken($cardToken);

        $card = Card::delete($request, $this->options);

        return $card;
    }

    /**
     * Build the payment request
     */
    private function buildPaymentRequest($order, $user, $cardData)
    {
        $request = new CreatePaymentRequest();
        $request->setLocale(Locale::TR);
        $request->setConversationId('order_' . $order->id);
        $request->setPrice(number_format($order->price, 2, '.', ''));
        $request->setPaidPrice(number_format($order->price, 2, '.', ''));
        $request->setCurrency(Currency::TL);
        $request->setInstallment(1);
        $request->setBasketId('order_' . $order->id);
        $request->setPaymentChannel(PaymentChannel::MOBILE);
        $request->setPaymentGroup(PaymentGroup::PRODUCT);

        // Build payment card
        $paymentCard = new PaymentCard();

        if (!empty($cardData['card_token']) && !empty($cardData['card_user_key'])) {
            // Saved card payment
            $paymentCard->setCardToken($cardData['card_token']);
            $paymentCard->setCardUserKey($cardData['card_user_key']);
        } else {
            // New card payment
            $paymentCard->setCardHolderName($cardData['card_holder_name']);
            $paymentCard->setCardNumber($cardData['card_number']);
            $paymentCard->setExpireMonth($cardData['expire_month']);
            $paymentCard->setExpireYear($cardData['expire_year']);
            $paymentCard->setCvc($cardData['cvc']);

            // Register card if requested
            if (!empty($cardData['register_card'])) {
                $paymentCard->setRegisterCard(1);
            }
        }

        $request->setPaymentCard($paymentCard);

        // Buyer
        $buyer = new Buyer();
        $buyer->setId('BUY_' . $user->id);
        $buyer->setName($user->first_name ?? 'Customer');
        $buyer->setSurname($user->last_name ?? '.');
        $buyer->setGsmNumber($user->phone ?? '+905000000000');
        $buyer->setEmail($user->email ?? 'customer@email.com');
        $buyer->setIdentityNumber('11111111111');
        $buyer->setRegistrationAddress($user->user_city?->city ?? 'Istanbul');
        $buyer->setIp(request()->ip());
        $buyer->setCity($user->user_city?->city ?? 'Istanbul');
        $buyer->setCountry('Turkey');
        $buyer->setZipCode('34000');
        $buyer->setLastLoginDate(date('Y-m-d H:i:s'));
        $buyer->setRegistrationDate($user->created_at ? $user->created_at->format('Y-m-d H:i:s') : date('Y-m-d H:i:s'));
        $request->setBuyer($buyer);

        // Shipping Address
        $shippingAddress = new Address();
        $shippingAddress->setContactName(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
        $shippingAddress->setCity($user->user_city?->city ?? 'Istanbul');
        $shippingAddress->setCountry('Turkey');
        $shippingAddress->setAddress($user->user_city?->city ?? 'Istanbul');
        $shippingAddress->setZipCode('34000');
        $request->setShippingAddress($shippingAddress);

        // Billing Address
        $billingAddress = new Address();
        $billingAddress->setContactName(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
        $billingAddress->setCity($user->user_city?->city ?? 'Istanbul');
        $billingAddress->setCountry('Turkey');
        $billingAddress->setAddress($user->user_city?->city ?? 'Istanbul');
        $billingAddress->setZipCode('34000');
        $request->setBillingAddress($billingAddress);

        // Basket Items
        $basketItems = [];
        $firstBasketItem = new BasketItem();
        $firstBasketItem->setId('BI_order_' . $order->id);
        $firstBasketItem->setName('Service Payment #' . $order->id);
        $firstBasketItem->setCategory1('Service');
        $firstBasketItem->setCategory2('Marketplace');
        $firstBasketItem->setItemType(BasketItemType::VIRTUAL);
        $firstBasketItem->setPrice(number_format($order->price, 2, '.', ''));
        $basketItems[] = $firstBasketItem;
        $request->setBasketItems($basketItems);

        return $request;
    }
}

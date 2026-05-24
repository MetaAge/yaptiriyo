<?php

namespace App\Http\Controllers\Api\Freelancer;

use App\Http\Controllers\Controller;
use App\Http\Services\Frontend\IyzicoPaymentService;
use Illuminate\Http\Request;

class IyzicoCardController extends Controller
{
    /**
     * List saved cards for the authenticated user
     */
    public function listCards()
    {
        $user = auth('sanctum')->user();
        $iyzicoService = new IyzicoPaymentService();

        $cardList = $iyzicoService->getCards($user);

        if ($cardList === null) {
            return response()->json([
                'status' => 'success',
                'cards' => [],
                'msg' => __('No saved cards found')
            ]);
        }

        if ($cardList->getStatus() !== 'success') {
            return response()->json([
                'status' => 'error',
                'cards' => [],
                'msg' => $cardList->getErrorMessage() ?? __('Failed to retrieve cards')
            ], 422);
        }

        $cards = [];
        if ($cardList->getCardDetails()) {
            foreach ($cardList->getCardDetails() as $card) {
                $cards[] = [
                    'card_token' => $card->getCardToken(),
                    'card_user_key' => $cardList->getCardUserKey(),
                    'card_alias' => $card->getCardAlias(),
                    'bin_number' => $card->getBinNumber(),
                    'last_four_digits' => $card->getLastFourDigits(),
                    'card_type' => $card->getCardType(),
                    'card_association' => $card->getCardAssociation(),
                    'card_family' => $card->getCardFamily(),
                    'card_bank_name' => $card->getCardBankName(),
                    'card_bank_code' => $card->getCardBankCode(),
                ];
            }
        }

        return response()->json([
            'status' => 'success',
            'cards' => $cards,
        ]);
    }

    /**
     * Save a new card
     */
    public function saveCard(Request $request)
    {
        $request->validate([
            'card_holder_name' => 'required|string|max:100',
            'card_number' => 'required|string|min:15|max:19',
            'expire_month' => 'required|string|size:2',
            'expire_year' => 'required|string|size:4',
            'card_alias' => 'nullable|string|max:50',
        ]);

        $user = auth('sanctum')->user();
        $iyzicoService = new IyzicoPaymentService();

        $result = $iyzicoService->saveCard($user, [
            'card_holder_name' => $request->card_holder_name,
            'card_number' => str_replace(' ', '', $request->card_number),
            'expire_month' => $request->expire_month,
            'expire_year' => $request->expire_year,
            'card_alias' => $request->card_alias ?? 'Kartım',
        ]);

        if ($result->getStatus() === 'success') {
            return response()->json([
                'status' => 'success',
                'msg' => __('Card saved successfully'),
                'card_user_key' => $result->getCardUserKey(),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'msg' => $result->getErrorMessage() ?? __('Failed to save card'),
        ], 422);
    }

    /**
     * Delete a saved card
     */
    public function deleteCard(Request $request)
    {
        $request->validate([
            'card_token' => 'required|string',
        ]);

        $user = auth('sanctum')->user();
        $iyzicoService = new IyzicoPaymentService();

        $result = $iyzicoService->deleteCard($user, $request->card_token);

        if ($result === null) {
            return response()->json([
                'status' => 'error',
                'msg' => __('No saved cards found'),
            ], 422);
        }

        if ($result->getStatus() === 'success') {
            return response()->json([
                'status' => 'success',
                'msg' => __('Card deleted successfully'),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'msg' => $result->getErrorMessage() ?? __('Failed to delete card'),
        ], 422);
    }

    /**
     * Retrieve installment options for a given BIN number and price
     */
    public function getInstallmentOptions(Request $request)
    {
        $request->validate([
            'bin_number' => 'required|string|size:6',
            'price' => 'required|numeric|min:0.1',
        ]);

        $iyzicoService = new IyzicoPaymentService();
        $result = $iyzicoService->getInstallmentInfo($request->bin_number, $request->price);

        if ($result->getStatus() === 'success') {
            $installmentDetails = [];
            
            // Parse details
            $details = $result->getInstallmentDetails();
            if (!empty($details)) {
                foreach ($details as $detail) {
                    $prices = $detail->getInstallmentPrices();
                    $installmentPrices = [];
                    foreach ($prices as $price) {
                        $installmentPrices[] = [
                            'installment_price' => $price->getInstallmentPrice(),
                            'total_price' => $price->getTotalPrice(),
                            'installment_number' => $price->getInstallmentNumber(),
                        ];
                    }
                    
                    $installmentDetails[] = [
                        'bin_number' => $detail->getBinNumber(),
                        'price' => $detail->getPrice(),
                        'card_type' => $detail->getCardType(),
                        'card_association' => $detail->getCardAssociation(),
                        'card_family' => $detail->getCardFamilyName(),
                        'bank_name' => $detail->getBankName(),
                        'bank_code' => $detail->getBankCode(),
                        'installment_prices' => $installmentPrices,
                    ];
                }
            }

            return response()->json([
                'status' => 'success',
                'installment_details' => $installmentDetails,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'msg' => $result->getErrorMessage() ?? __('Failed to retrieve installment options'),
        ], 422);
    }
}

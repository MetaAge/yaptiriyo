<?php

namespace App\Http\Controllers\Api\Client;

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
}

<?php

namespace App\Services;

use App\Models\Barcode;
use App\Models\Bottle;

class RefundService
{

    public function __construct(private LnbitsService $lnbitsService)
    {
    }

    public function checkBarcode($barcodeText)
    {

        $barcode = Barcode::where('barcode', $barcodeText)->first();
        if (!$barcode) {
            return response()->json(['success' => false, 'error' => 'not_found'], 404);
        }

        if ($barcode->refunded_at) {
            return response()->json(['success' => false, 'error' => 'refunded'], 400);
        }

        $barcode->withdraw_attempts++;
        $barcode->save();

        if ($barcode->withdraw_attempts > 5) {
            return response()->json(['success' => false, 'error' => 'withdraw_attempts_exceeded'], 400);
        }

        if (!$barcode->withdraw_id) {
            $bottleId = $barcode->bottle_id;
            $bottlePrice = $this->getPrice($bottleId);
            $withdrawLink = $this->lnbitsService->createWithdrawLink($bottlePrice, $barcode->id);
            $barcode->withdraw_id = $withdrawLink['id'];
            $barcode->save();
        }

        if ($this->lnbitsService->isWithdrawLinkPaid($barcode->withdraw_id)) {
            $barcode->refunded_at = now();
            $barcode->save();
            return response()->json(['success' => false, 'error' => 'refunded'], 400);
        }

        $refund = $this->lnbitsService->getRefund($barcode->withdraw_id);

        return response()->json(['success' => true, 'svg' => $refund], 200);
    }

    public function getPrice($bottleId)
    {
        $bottle = Bottle::find($bottleId);
        $bottlePricePln = $bottle->price;

        return $this->lnbitsService->getSatsAmountFromPLN($bottlePricePln);
    }
}

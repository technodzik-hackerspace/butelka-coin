<?php

namespace App\Http\Controllers;

use App\Services\RefundService;
use Illuminate\Http\Request;

class Refund extends Controller
{
    protected RefundService $refundService;

    public function __construct(RefundService $refundService)
    {
        $this->refundService = $refundService;
    }

    public function check(Request $request)
    {
        $request->validate([
            'barcode' => 'required|string',
        ]);

        if (!str_starts_with($request->barcode, '420')) {
            return response()->json(['success' => false, 'error' => 'alien_barcode'], 400);
        }

        return $this->refundService->checkBarcode($request->barcode);
    }
}

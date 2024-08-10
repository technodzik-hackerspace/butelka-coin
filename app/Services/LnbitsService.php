<?php

namespace App\Services;

use GuzzleHttp\Client;

class LnbitsService
{

    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('LNBITS_HOST'),
            'headers' => [
                'X-Api-Key' => env('LNBITS_API_KEY'),
            ],
        ]);
    }

    public function createWithdrawLink($amount, $barcodeId)
    {
        $response = $this->client->post('withdraw/api/v1/links', [
            'json' => [
                "title" => "ButelkaCoin refund",
                "min_withdrawable" => $amount,
                "max_withdrawable" => $amount,
                "uses" => 1,
                "is_unique" => true,
                "wait_time" => 1,
                "webhook_url" => env('WITHDRAW_WEBHOOK_URL'),
                "webhook_body" => json_encode(['barcode_id' => $barcodeId]),
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getWithdrawLink($withdrawLink)
    {
        $response = $this->client->get('withdraw/api/v1/links/' . $withdrawLink);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getConvertedValue($from, $to, $amount)
    {
        $response = $this->client->post('api/v1/conversion', [
            'json' => [
                'from_' => $from,
                'amount' => $amount,
                'to' => $to,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getSatsAmountFromPLN($amount): int
    {
        $roundTo = 10;

        $rawSats = $this->getConvertedValue('PLN', 'sat', $amount);

        $sats = round($rawSats['sats'] / $roundTo) * $roundTo;

        return (int)$sats;
    }

    public function getRefund(string $withdrawId)
    {
        $response = $this->client->get('withdraw/print/' . $withdrawId);

        return $response->getBody()->getContents();
    }

    public function isWithdrawLinkPaid(string $withdrawId)
    {
        $linkInfo = $this->getWithdrawLink($withdrawId);

        return $linkInfo['used'] > 0;
    }
}

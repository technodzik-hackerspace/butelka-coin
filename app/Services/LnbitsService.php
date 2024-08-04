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

    public function createWithdrawLink($amount, $uses)
    {
        $response = $this->client->post('withdraw/api/v1/links', [
            'json' => [
                'amount' => $amount,
                'uses' => $uses,
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
}

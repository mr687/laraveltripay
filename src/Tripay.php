<?php

namespace Mr687\Laraveltripay;

use Illuminate\Support\Facades\Http;

class Tripay
{
    protected const ENDPOINT_SANBOX = 'https://tripay.co.id/api-sandbox/';
    protected const ENDPOINT = 'https://tripay.co.id/api/';

    public function req($method = 'get', $route = null, $params = null)
    {
        $token = config('tripay.api_key');
        $response = Http::withToken($token)
            ->$method(
                self::getUrl($route),
                $params
            )
            ->throw();
        return $response->ok() || $response->successful() ?
            $response : null;
    }

    public function getUrl($route)
    {
        if (config('tripay.production')) {
            return self::ENDPOINT . $route;
        }
        return self::ENDPOINT_SANBOX . $route;
    }

    public function transactionDetail($reference)
    {
        if (!$reference) return null;
        $route = 'transaction/detail';
        $response = self::req('get', $route, [
            'reference' => $reference
        ]);
        return $response->json();
    }

    public function transaction($data)
    {
        $route = 'transaction/create';
        if (!isset($data['callback_url'])) {
            $data['callback_url'] = url('payment/callback');
        }
        if (!isset($data['return_url'])) {
            $data['return_url'] = url('payment/landing');
        }
        $response = self::req('post', $route, $data);
        return $response->json();
    }

    public function channels($limit = 3)
    {
        $route = 'merchant/payment-channel';
        $response = self::req('get', $route);
        if ($response['data']) {
            if ($limit) {
                return array_slice($response['data'], 0, $limit);
            }
            return $response['data'];
        }
        return [];
    }

    public function generateCallbackSignature($json)
    {
        $privateKey = config('tripay.private_key');
        return hash_hmac('sha256', $json, $privateKey);
    }

    public function generateSignature($ref = null, $amount = null)
    {
        $privateKey = config('tripay.private_key');
        $merchantCode = config('tripay.merchant_code');
        return hash_hmac('sha256', $merchantCode . $ref . $amount, $privateKey);
    }
}

<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BotNotificationService
{
    private static function sendRequest($url, $params) {
        $auth_key = env('BOT_API_TOKEN');
        $base_url = env('BOT_API_URL');
        $url = $base_url . $url;

        $client = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Auth-Key' => $auth_key,
        ])->post($url, $params);

        $response = $client->json();
        return $response;
    }

    public function checkStatus($params) {
        $url = 'check/status';
        $this->sendRequest($url, $params);
    }

    public function questionAnswer($params) {
        $url = 'question/answer';
        $this->sendRequest($url, $params);
    }

    public function checkRegister($params) {
        $url = 'check/register';
        $this->sendRequest($url, $params);
    }

    public function takePrize($params) {
        $url = 'take/prize';
        $this->sendRequest($url, $params);
    }
}

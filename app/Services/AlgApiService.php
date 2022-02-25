<?php

namespace App\Services;

use App\Models\Envoy;
use App\Models\FailedRequest;
use Http;

class AlgApiService{
    public  function sendRequest($url, $params) {
        $base_url = env('ALG_API');
        $url = $base_url . $url;

        $client = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-Auth' => 'AFkm10kIlm5xC'
        ])->post($url, $params);

        if($client->successful()) {
            $response = $client->object();

            $envoy = Envoy::create([
                'request' => json_encode(['url' => $url, 'params' => $params], JSON_UNESCAPED_UNICODE),
                'response' => json_encode($response, JSON_UNESCAPED_UNICODE),
                'type' => 'alg',
                'user_id' => auth()->check() ? auth()->id() : null
            ]);

            return (object) ['response' => $response, 'envoy_id' => $envoy->id];
        } else {
            $response = $client->object();

            FailedRequest::create([
                'request' => json_encode(['url' => $url, 'params' => $params], JSON_UNESCAPED_UNICODE),
                'response' => json_encode($response, JSON_UNESCAPED_UNICODE),
                'user_id' => auth()->check() ? auth()->id() : null
            ]);

            return (object) ['response' => $response, 'envoy_id' => null];
        }
    }

    public function userRegister($params) {
        $url = '';
        return $this->sendRequest($url, $params);
    }

    public function gamePrize() {
        $url = '/' . auth()->user()->phone . '/games';
        return $this->sendRequest($url, ['ip_address' => $this->getIpAddress()]);
    }

    public function prizeCatch($params) {
        $url = '/' . auth()->user()->phone . '/catch';
        return $this->sendRequest($url, $params);
    }

    public function prizeConfirm($params) {
        $url = '/' . auth()->user()->phone . '/confirm';
        return $this->sendRequest($url, $params);
    }

    public function getIpAddress() {
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        if($ip == "::1"){ $ip = "127.0.0.1";}
        return $ip;
    }
}

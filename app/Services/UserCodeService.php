<?php

namespace App\Services;

use App\Models\Envoy;
use Http;

class UserCodeService{
    public function send($phone) {
        $url = 'https://smsc.ru/sys/send.php';

        $params = [
            'login' => 'twixeba22',
            'psw' => 'global777',
            'phones' => $phone,
            'mes' => 'code',
            'call' => 1,
            'fmt' => 3
        ];

        $client = Http::get($url, $params);

        if($client->successful()) {
            $response = $client->json();

            Envoy::create([
                'request' => json_encode(['url' => $url, 'params' => $params], JSON_UNESCAPED_UNICODE),
                'response' => json_encode($response, JSON_UNESCAPED_UNICODE),
                'type' => 'user_code'
            ]);

            return substr($response['code'], '-4');
        }
        return abort();
    }
}

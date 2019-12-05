<?php

namespace App\Repositories;

use App\Models\Settings;
use GuzzleHttp\Client;

class BridgeRepository extends Repository
{
    public function getNewIdentificator()
    {
        $httpClient = new Client();
        $url = Config::get('moring.bridgeUrl') . Config::get('moring.bridgeCreateIdentificatorUrl'); # Url getting from /config/moring.php
        $response = $httpClient->request('GET', $url, ['allow_redirects' => false]);

        $settings = new Settings();
        $settings->parameter = 'identificator';
        $settings->value = json_decode($response->getBody(), true);
        $settings->save();
    }
}

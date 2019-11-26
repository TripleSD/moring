<?php

namespace App\Http\Controllers\Admin\Bridge;

use App\Http\Controllers\Admin\Statistics\IdentificatorsController;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class BridgeController extends Controller
{
    public function getInfo()
    {
        try {
            $identificator = new IdentificatorsController();

            if ($identificator->getIdentificator() == null) {
                $httpClient = new Client();
                $url = Config::get('moring.bridgeUrl') . Config::get('moring.bridgeCreateIdentificatorUrl'); # Url getting from /config/moring.php
                $response = $httpClient->request('GET', $url, ['allow_redirects' => false]);

                $settings = new Settings();
                $settings->parameter = 'identificator';
                $settings->value = json_decode($response->getBody(), true);
                $settings->save();
            }

            $httpClient = new Client();
            $response = $httpClient->request('GET', Config::get('moring.bridgeUrl') . Config::get('moring.bridgeCurrentVersionUrl'),
                ['query' => ['identificator' => $identificator->getIdentificator()], 'allow_redirects' => false]);
            $bridgeBuild = json_decode($response->getBody(), true);
            return array('version' => $bridgeBuild, 'status' => '1', 'statusCode' => $response->getStatusCode());
        } catch (\Exception $e) {

        }
    }
}
<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class BridgeRepository extends Repository
{
    public function getNewIdentificator()
    {
        $httpClient = new Client();
        $url = Config::get('moring.bridgeUrl') . Config::get(
                'moring.bridgeCreateIdentificatorUrl'
            ); # Url getting from /config/moring.php
        $response = $httpClient->request('GET', $url, ['allow_redirects' => false]);
        return json_decode($response->getBody(), true);
    }

    public function getBridgeInfo($identificator)
    {
        $httpClient = new Client();
        $response = $httpClient->request(
            'GET',
            Config::get('moring.bridgeUrl') . Config::get('moring.bridgeCurrentVersionUrl'),
            ['query' => ['identificator' => $identificator], 'allow_redirects' => false]
        );
        $bridgeBuild = json_decode($response->getBody(), true);
        return array('version' => $bridgeBuild, 'status' => '1', 'statusCode' => $response->getStatusCode());
    }
}

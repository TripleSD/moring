<?php

namespace App\Http\Controllers\Admin\Bridge;

use App\Http\Controllers\Admin\Statistics\IdentificatorsController;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class BridgeController extends Controller
{
    public function getInfo()
    {
        try {
            $identificator = new IdentificatorsController();

            $httpClient = new Client();
            $response = $httpClient->request('GET', Config::get('moring.bridgeUrl') . Config::get('moring.bridgeCurrentVersionUrl'),
                ['query' => ['identificator' => $identificator->getIdentificator()], 'allow_redirects' => false]);
            $responseArray = json_decode($response->getBody(), true);
            return array('version' => $responseArray[0], 'status' => '1', 'statusCode' => $request->getStatusCode());
        } catch (\Exception $e) {
            return array('version' => '-', 'status' => '0', 'statusCode' => '-');
        }
    }
}
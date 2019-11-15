<?php

namespace App\Http\Controllers\Admin\Bridge;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class BridgeController extends Controller
{
    public function getInfo()
    {
        try {
            $httpClient = new Client();
            $request = $httpClient->request('GET', \Config::get('moring.bridgeVersionUrl'), ['allow_redirects' => false]);
            $response = $request->getBody();
            $responseArray = json_decode($response, true);
            return array('version' => $responseArray[0], 'status' => '1','statusCode' => $request->getStatusCode());
        } catch (\Exception $e) {
            return array('version' => '-', 'status' => '0','statusCode' => '-');
        }
    }
}
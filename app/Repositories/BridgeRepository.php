<?php

namespace App\Repositories;

use App\Models\BridgeStatistics;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class BridgeRepository extends Repository
{
    public function getNewIdentificator()
    {
        $httpClient = new Client();
        // Url getting from /config/moring.php
        $url = Config::get('moring.bridgeUrl') . Config::get(
                'moring.bridgeCreateIdentificatorUrl'
            );
        $response = $httpClient->request('GET', $url,
                                         ['query' => ['env' => env('APP_ENV')],
                                         'allow_redirects' => false]);

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

        return ['version' => $bridgeBuild, 'status' => '1', 'statusCode' => $response->getStatusCode()];
    }

    public function updateStatInfo($param)
    {
        return BridgeStatistics::where('parameter', $param)
            ->update(['updated_at' => Carbon::now()->format('Y-m-d H:i:s')]);
    }

    public function getBridgeStatistics()
    {
        return BridgeStatistics::pluck('updated_at', 'parameter')->toArray();
    }
}

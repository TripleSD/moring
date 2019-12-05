<?php

namespace App\Http\Controllers\Admin\Bridge;

use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class BridgeController extends Controller
{
    private $settingsController;

    public function __construct()
    {
        $this->settingsController = new SettingsController();
    }

    public function getInfo()
    {
        try {
            $identificator = $this->settingsController->getIdentificator();

            $settings = new Settings();
            $settings->parameter = 'identificator';
            $settings->value = json_decode($response->getBody(), true);
            $settings->save();

            $httpClient = new Client();
            $response = $httpClient->request(
                'GET',
                Config::get('moring.bridgeUrl') . Config::get('moring.bridgeCurrentVersionUrl'),
                ['query' => ['identificator' => $identificator], 'allow_redirects' => false]
            );
            $bridgeBuild = json_decode($response->getBody(), true);
            return array('version' => $bridgeBuild, 'status' => '1', 'statusCode' => $response->getStatusCode());
        } catch (\Exception $e) {
        }
    }
}

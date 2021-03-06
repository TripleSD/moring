<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Models\BridgePhpVersions;
use App\Repositories\BridgeRepository;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class BridgePHPVersionsChecker extends Command
{
    public $settingsController;
    private $bridgeRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BridgePHPVersionsChecker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->settingsController = new SettingsController();
        $this->bridgeRepository   = new BridgeRepository();
    }

    public function handle()
    {
        $identificator = $this->settingsController->getIdentificator();

        // Getting availible Moring versions from bridge
        $httpClient = new Client();
        // Url getting from /config/moring.php
        $url                 = Config::get('moring.bridgeUrl') . Config::get('moring.bridgeCurrentPHPVersionsUrl');
        $response            = $httpClient->request(
            'GET',
            $url,
            ['query' => ['identificator' => $identificator], 'allow_redirects' => false]
        );
        $versionsBridgeArray = json_decode($response->getBody(), true);

        foreach ($versionsBridgeArray as $versionArray) {
            try {
                $localVersionsArray = BridgePhpVersions::pluck('version')->toArray();
                if (! in_array($versionArray['version'], $localVersionsArray)) {
                    $versions                    = new BridgePhpVersions();
                    $versions->version           = $versionArray['version'];
                    $versions->branch            = $versionArray['branch'];
                    $versions->deprecated_status = $versionArray['deprecated_status'];
                    $versions->save();
                } else {
                    $version                    = BridgePhpVersions::where(
                        'version',
                        $versionArray['version']
                    )->firstOrFail();
                    $version->deprecated_status = $versionArray['deprecated_status'];
                    $version->save();
                }
            } catch (\Exception $e) {
            }
        }
        $this->bridgeRepository->updateStatInfo('bridge_php_versions');
    }
}

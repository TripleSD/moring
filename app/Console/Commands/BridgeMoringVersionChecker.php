<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Models\MoringVersions;
use App\Repositories\BridgeRepository;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class BridgeMoringVersionChecker extends Command
{
    private $settingsController;
    private $bridgeRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BridgeMoringVersionChecker';

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
        $this->bridgeRepository = new BridgeRepository();
    }

    public function handle()
    {
        $identificator = $this->settingsController->getIdentificator();

        // Getting availible Moring versions from bridge
        $httpClient = new Client();
        // Url getting from /config/moring.php
        $url = Config::get('moring.bridgeUrl') . Config::get(
                'moring.bridgeCurrentMoringVersionUrl'
            );
        $response = $httpClient->request(
            'GET',
            $url,
            ['query' => ['identificator' => $identificator], 'allow_redirects' => false]
        );
        $versionsBridgeArray = json_decode($response->getBody(), true);

        foreach ($versionsBridgeArray as $created_at => $build) {
            try {
                $localVersionsArray = MoringVersions::pluck('build')->toArray();
                if (! in_array($build, $localVersionsArray)) {
                    $versions = new MoringVersions();
                    $versions->build = $build;
                    $versions->created_at = $created_at;
                    $versions->save();
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
        $this->bridgeRepository->updateStatInfo('bridge_moring_versions');
    }
}

<?php

namespace App\Console\Commands;

use App\Models\MoringVersions;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class MoringVersionChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MoringVersionChecker';

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
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        # Getting availible Moring versions from bridge
        $httpClient = new Client();
        $url = Config::get('moring.bridgeCurrentMoringVersionUrl'); # Url getting from /config/moring.php
        $response = $httpClient->request('GET', $url, ['allow_redirects' => false]);
        $versionsBridgeArray = json_decode($response->getBody(), true);

        foreach ($versionsBridgeArray as $versionBridgeItem) {
            try {
                $localVersionsArray = MoringVersions::pluck('version')->toArray();
                if(!in_array($versionBridgeItem['version'], $localVersionsArray)) {
                    $versions = new MoringVersions();
                    $versions->version = $versionBridgeItem['version'];
                    $versions->human_version = $versionBridgeItem['human_version'];
                    $versions->save();
                }
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}

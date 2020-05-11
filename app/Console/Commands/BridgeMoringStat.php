<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Models\MoringVersions;
use App\Repositories\BridgeRepository;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class BridgeMoringStat extends Command
{
    private $settingsController;
    private $bridgeRepository;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BridgeMoringStat';

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
        $httpClient = new Client();

        $url = Config::get('moring.bridgeUrl') . Config::get(
                'moring.bridgeUpdateUseMoringVersion'
            );

        $httpClient->request(
            'POST',
            $url,
            [
                'query' => [
                    'identificator' => $this->settingsController->getIdentificator(),
                    'version' => Config::get('moring.version'),
                ],
                'allow_redirects' => false,
            ]
        );
    }
}

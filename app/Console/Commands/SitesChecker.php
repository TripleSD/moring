<?php

namespace App\Console\Commands;

use App\Models\ChecksSites;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class SitesChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SitesChecker';

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
        $sites = ChecksSites::get();

        foreach ($sites as $site) {
            try {
                if ($site->control_file != null) {
                    $httpClient = new Client();
                    $request = $httpClient->request('GET', $site->control_file,['allow_redirects' => false]);
                    $response = $request->getBody();
                    $responseArray = json_decode($response, true);
                    $phpVersion = $responseArray['php_version'];
                    $statusCode = $request->getStatusCode();
                    $serverInfo = $responseArray['server_info'];
                } else {
                    $httpClient = new Client();
                    $response = $httpClient->request('GET', $site->url,['allow_redirects' => false]);
                    $phpVersion = $response->getHeader('X-Powered-By');
                    $serverInfo =  $response->getHeader('server');

                    if(!empty($phpVersion[0])) {
                        $phpVersion = preg_replace('/[^\d.]/','',$phpVersion[0]);
                    } else {
                        $phpVersion = '';
                    }

                    $statusCode = $response->getStatusCode();
                }
            } catch (\Exception $e) {
                $statusCode = 999;
                $phpVersion = $site->php_version;
                $serverInfo = $site->server_info;
            }


            $site = ChecksSites::find($site->id);
            $site->php_version = $phpVersion;
            $site->http_code = $statusCode;
            $site->server_info = $serverInfo;
            $site->save();
        }
    }
}

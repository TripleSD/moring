<?php

namespace App\Console\Commands;

use App\Models\Sites;
use App\Models\SitesHttpCodes;
use App\Models\SitesPhpVersions;
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
        $sites = Sites::get();
        foreach ($sites as $site) {
            try {
                if ($site->checksList->use_file === 1) {
                    $httpClient = new Client();
                    $url = ($site->https === 1) ? "https://" . $site->url : "http://" . $site->url;
                    $request = $httpClient->request('GET', $url,['allow_redirects' => false]);
                    $response = $request->getBody();
                    $responseArray = json_decode($response, true);
                    $phpVersion = $responseArray['php_version'];
                    $statusCode = $request->getStatusCode();
                    $serverInfo = $responseArray['server_info'];
                } else {
                    $httpClient = new Client();
                    $url = ($site->https === 1) ? "https://" . $site->url : "http://" . $site->url;
                    $response = $httpClient->request('GET', $url,['allow_redirects' => false]);
                    $phpVersion = $response->getHeader('X-Powered-By');
                    $serverInfo =  $response->getHeader('server');
                    if(!empty($phpVersion[0])) {
                        $phpVersion = preg_replace('/[^\d.]/','',$phpVersion[0]);
                    } else {
                        $phpVersion = 0;
                    }
                    $statusCode = $response->getStatusCode();
                }
            } catch (\Exception $e) {
                $statusCode = 999;
                $phpVersion = 0;
                $serverInfo = $site->server_info;
            }

            //   HTTP code saving process
            $http = SitesHttpCodes::where('site_id', $site->id)->first();
            if (isset($http)) {
                $http->http_code = $statusCode;
            } else {
                $fillable = ['site_id' => $site->id, 'http_code' => $statusCode];
                $http = new SitesHttpCodes($fillable);
            }
            $http->save();

            //    PHP version saving process
            $php = SitesPhpVersions::where('site_id', '=', $site->id)->first();
            if (isset($php)) {
                $php->php_version = $phpVersion;
            } else {
                $fillable = ['site_id' => $site->id, 'php_version' => $phpVersion];
                $php = new SitesPhpVersions($fillable);
            }
            $php->save();

        }
    }
}

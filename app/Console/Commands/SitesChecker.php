<?php

namespace App\Console\Commands;

use App\Models\Sites;
use App\Models\SitesHttpCodes;
use App\Models\SitesPhpVersions;
use App\Models\SitesWebServers;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

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
    public function handle(int $site_id = null)
    {
        if (is_null($site_id)) {
            $sites = Sites::get();
        }   else {
            $sites[] = Sites::find($site_id);
        }
        foreach ($sites as $site) {
            try {
                if ($site->checksList->use_file === 1) {
                    $httpClient = new Client();
                    $url = ($site->https === 1 && $site->checksList->check_https === 1) ? "https://" . $site->url : "http://" . $site->url;
                    $request = $httpClient->request('GET', $url,['allow_redirects' => false]);
                    $response = $request->getBody();
                    //TODO тут не подставляется url файла moring
                    $responseArray = json_decode($response, true);
                    $phpVersion = $responseArray['php-version'];
                    $statusCode = $request->getStatusCode();
                    $webServerType = $responseArray['server_info'];
                } else {
                    $httpClient = new Client();
                    $url = ($site->https === 1 && $site->checksList->check_https === 1) ? "https://" . $site->url : "http://" . $site->url;
                    $response = $httpClient->request('GET', $url,['allow_redirects' => false]);
                    $phpVersion = $response->getHeader('X-Powered-By');
                    $webServerType =  $response->getHeader('server')[0];
                    if(!empty($phpVersion[0])) {
                        $phpVersion = preg_replace('/[^\d.]/','',$phpVersion[0]);
                        $phpBranchRaw = explode('.', $phpVersion);
                        $phpBranchRaw = $phpBranchRaw[0] * 10000 + $phpBranchRaw[1] * 100 + $phpBranchRaw[2];
                        $phpBranch = Str::substr($phpBranchRaw,0,3);
                    } else {
                        $phpVersion = 0;
                        $phpBranch = 0;
                    }
                    $statusCode = $response->getStatusCode();
                }
            } catch (\Exception $e) {
                $statusCode = 999;
                $phpVersion = 0;
                $phpBranch = 0;
                $webServerType = "No_name_found";
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


            //   HTTP code saving process
            $webServer = SitesWebServers::where('site_id', $site->id)->first();
            if (isset($webServer)) {
                $webServer->web_sever = $webServerType;
            } else {
                $fillable = ['site_id' => $site->id, 'web_server' => $webServerType];
                $webServer = new SitesWebServers($fillable);
            }
            $webServer->save();

            //    PHP version saving process
            $php = SitesPhpVersions::where('site_id', $site->id)->first();
            if (isset($php)) {
                $php->version = $phpVersion;
                $php->branch = $phpBranch;
            } else {
                $fillable = ['site_id' => $site->id, 'version' => $phpVersion, 'branch' => $phpBranch];
                $php = new SitesPhpVersions($fillable);
            }
            $php->save();

        }
    }
}

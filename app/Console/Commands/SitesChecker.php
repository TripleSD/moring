<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Connectors\TelegramConnector;
use App\Models\Sites;
use App\Models\SitesHttpCodes;
use App\Models\SitesPhpVersions;
use App\Models\SitesWebServers;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Str;

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

    public $settingsController;
    public $telegramConnector;

    public function __construct()
    {
        parent::__construct();
        $this->settingsController = new SettingsController();
        $this->telegramConnector  = new TelegramConnector();
    }

    public function handle(int $site_id = null)
    {
        if ($site_id === null) {
            $sites     = Sites::get();
            $tgMessage = 0;
        } else {
            $sites[]   = Sites::find($site_id);
            $tgMessage = 1;
        }

        /*
         * http_response_code()
         * true - web
         * false - cli
         */

        foreach ($sites as $site) {
            if (http_response_code() == false) {
                $fork = pcntl_fork();

                if ($fork) {
                    echo $site->title . PHP_EOL;
                    self::ckeckSite($site);
                    die(0);
                }
            } else {
                self::ckeckSite($site);
            }
        }

        if ($this->settingsController->getTelegramStatus() === 1) {
            try {
                $date   = Carbon::now()->format('Y-m-d H:i:s');
                $chatId = $this->settingsController->getGroupChatId();
                if ($tgMessage == 0) {
                    $this->telegramConnector->sendMessage(
                        $chatId,
                        trim(
                            "ℹ️<b>Информация</b> \nВыполнена проверка всех сайтов.\nДата/время окончания задания: $date\nСтатус: ✅"
                        )
                    );
                } else {
                    $this->telegramConnector->sendMessage(
                        $chatId,
                        trim(
                            "ℹ️<b>Информация</b> \nВыполнена проверка одного сайтов.\nДата/время окончания задания: $date\nСтатус: ✅"
                        )
                    );
                }
            } catch (\Exception $e) {
            }
        }
    }

    private function ckeckSite($site): void
    {
        try {
            if ($site->checksList->use_file === 1) {
                $httpClient    = new Client();
                $url           = ($site->https === 1 && $site->checksList->check_https === 1) ? 'https://' . $site->file_url : 'http://' . $site->file_url;
                $request       = $httpClient->request('GET', $url, ['allow_redirects' => false]);
                $response      = $request->getBody();
                $responseArray = json_decode($response, true);
                $phpVersion    = $responseArray['php-version'];
                $statusCode    = $request->getStatusCode();
                $webServerType = $responseArray['web-server'];
                $phpBranch     = $responseArray['php-branch'];
            } else {
                $httpClient    = new Client();
                $url           = ($site->https === 1 && $site->checksList->check_https === 1) ? 'https://' . $site->url : 'http://' . $site->url;
                $response      = $httpClient->request('GET', $url, ['allow_redirects' => false]);
                $phpVersion    = $response->getHeader('X-Powered-By');
                $webServerType = $response->getHeader('server');

                if ($webServerType != null) {
                    $webServerType = $webServerType[0];
                } else {
                    $webServerType = 0;
                }

                if (preg_match('/^[0-9]*/', $response->getStatusCode())) {
                    $statusCode = $response->getStatusCode();
                } else {
                    $statusCode = 999;
                }

                if ($phpVersion != null) {
                    if (preg_match('/^PHP/', $phpVersion[0])) {
                        preg_match('/[0-9]*.[0-9].*[0-9]*/', $phpVersion[0], $rawPhpVersion);
                        $phpVersion   = $rawPhpVersion[0];
                        $phpBranchRaw = explode('.', $phpVersion);
                        $phpBranchRaw = $phpBranchRaw[0] * 10000 + $phpBranchRaw[1] * 100 + $phpBranchRaw[2];
                        $phpBranch    = Str::substr($phpBranchRaw, 0, 3);
                    } else {
                        $phpVersion = 0;
                        $phpBranch  = 0;
                    }
                } else {
                    $phpVersion = 0;
                    $phpBranch  = 0;
                }
            }

            $ssl = new SitesSSLChecker();
            $ssl->handle($site->id);

            //   HTTP code saving process
            $http = SitesHttpCodes::where('site_id', $site->id)->first();
            if (isset($http)) {
                $http->http_code = $statusCode;
            } else {
                $fillable = ['site_id' => $site->id, 'http_code' => $statusCode];
                $http     = new SitesHttpCodes($fillable);
            }
            $http->updated_at = Carbon::now();
            $http->save();

            //   WebServer type saving process
            $webServer = SitesWebServers::where('site_id', $site->id)->first();
            if (isset($webServer)) {
                $webServer->web_server = $webServerType;
            } else {
                $fillable  = ['site_id' => $site->id, 'web_server' => $webServerType];
                $webServer = new SitesWebServers($fillable);
            }
            $webServer->updated_at = Carbon::now();
            $webServer->save();

            //    PHP version saving process
            $php = SitesPhpVersions::where('site_id', $site->id)->first();
            if (isset($php)) {
                $php->version = $phpVersion;
                $php->branch  = $phpBranch;
            } else {
                $fillable = ['site_id' => $site->id, 'version' => $phpVersion, 'branch' => $phpBranch];
                $php      = new SitesPhpVersions($fillable);
            }
            $php->updated_at = Carbon::now();
            $php->save();

            // Now we remove pending status from site
            $pending = Sites::where('id', $site->id)->first();
            if ((int) ($pending->pending) === 1) {
                $pending->pending = 0;
                $pending->save();
            }
        } catch (\Exception $e) {
        }
    }
}

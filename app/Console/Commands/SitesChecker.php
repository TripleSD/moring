<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Connectors\TelegramConnector;
use App\Models\Sites;
use App\Models\SitesHttpCodes;
use App\Models\SitesPhpVersions;
use App\Models\SitesWebServers;
use Carbon\Carbon;
use Exception;
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
    protected $signature = 'SitesChecker {--cli} {--web} {--debug}';

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

    public function handle(int $site_id = null, $mode = null)
    {
        $cli   = false;
        $debug = false;

        if ($mode === null) {
            $cli   = $this->option('cli');
            $debug = $this->option('debug');
        }

        if ($cli) {
            $this->info('Start script.');
            $this->line('------------------------------------');

            $start = microtime(true);
        }

        if ($site_id === null) {
            $sites     = Sites::where('enabled', 1)->get();
            $tgMessage = 0;
        } else {
            $sites[]   = Sites::find($site_id);
            $tgMessage = 1;
        }

        foreach ($sites as $site) {
            if ($cli) {
                $this->warn("Start check: $site->url");
                $startTaskTime = microtime(true);
            }
            self::ckeckSite($site, $cli, $debug);

            if ($cli) {
                $endTaskTime = microtime(true);
                $delta       = $endTaskTime - $startTaskTime;

                $this->warn('End check!');
                $this->warn('Time: ' . $delta . 'sec.');
                $this->line('------------------------------------');
            }
        }

        if ($cli) {
            $finish = microtime(true);
            $delta  = $finish - $start;

            $this->info('Finish!');
            $this->info("Total time: $delta sec");
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

    private function ckeckSite($site, $cli = false, $debug = false): void
    {
        Sites::where('id', $site->id)->update(['ip_address' => gethostbyname($site->url)]);
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
                $url = ($site->https === 1 && $site->checksList->check_https === 1) ? 'https://' . $site->url : 'http://' . $site->url;
                $ch  = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, true);
                curl_setopt($ch, CURLOPT_NOBODY, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 15);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

                $output            = curl_exec($ch);
                $headers           = [];
                $output            = rtrim($output);
                $output            = strtolower($output);
                $data              = explode("\n", $output);
                $headers['status'] = $data[0];

                array_shift($data);

                foreach ($data as $part) {
                    //some headers will contain ":" character (Location for example), and the part after ":" will be lost, Thanks to @Emanuele
                    $middle = explode(':', $part, 2);

                    //Supress warning message if $middle[1] does not exist, Thanks to @crayons
                    if (! isset($middle[1])) {
                        $middle[1] = null;
                    }

                    $headers[trim($middle[0])] = trim($middle[1]);
                }

                if ($cli) {
                    print_r($headers);
                }

                $phpVersion    = $headers['x-powered-by'] ?? null;
                $webServerType = $headers['server'];

                if ($webServerType === null) {
                    $webServerType = 0;
                }

                if (preg_match('/^[0-9]*/', $headers['status'])) {
                    preg_match('/[\d][\d][\d]/', $headers['status'], $rawStatusCode);
                    $statusCode = $rawStatusCode[0];
                } else {
                    $statusCode = 999;
                }

                if ($phpVersion != null) {
                    if (preg_match('/^PHP|php/', $phpVersion)) {
                        preg_match('/[\d][.]\d{1,2}[.]\d{1,2}/', $phpVersion, $rawPhpVersion);
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
        } catch (Exception $e) {
            if ($debug) {
                $this->warn($e->getMessage());
            }
        }
    }
}

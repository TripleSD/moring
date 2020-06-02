<?php

namespace App\Console\Commands;

use App\Models\BackupYandexConnectors;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BackupYandexConnectorsKeeper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:yandex-connectors-keeper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating information about Yandex Disk connectors';

    public function handle()
    {
        $connectors = BackupYandexConnectors::get();

        foreach ($connectors as $connector) {
            $ch = curl_init('https://cloud-api.yandex.net/v1/disk/');
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: OAuth ' . $connector->token]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, false);
            $res      = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
            curl_close($ch);

            $res = json_decode($res, true);

            if ($httpcode === 200) {
                BackupYandexConnectors::where('id', $connector->id)->update(
                    [
                        'total_space' => $res['total_space'],
                        'trash_size' => $res['trash_size'],
                        'used_space' => $res['used_space'],
                        'http_code' => $httpcode,
                        'status' => 1,
                        'status_updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]
                );
            } else {
                BackupYandexConnectors::where('id', $connector->id)->update(
                    [
                        'http_code' => $httpcode,
                        'status' => 0,
                        'status_updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                    ]
                );
            }

            print_r($res);
        }
    }
}

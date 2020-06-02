<?php

namespace App\Repositories\Backups;

use Carbon\Carbon;
use App\Repositories\Repository;
use App\Models\BackupYandexConnectors;

/**
 * Class YandexConnectorsRepository
 * @package App\Repositories\Backups
 */
class YandexConnectorRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getList()
    {
        return BackupYandexConnectors::get();
    }

    public function getPluckList()
    {
        return BackupYandexConnectors::pluck('description', 'id');
    }

    public function refresh($request)
    {
        $connector = BackupYandexConnectors::find($request->id);

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
                    'status_updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
            return true;
        }

        BackupYandexConnectors::where('id', $connector->id)->update(
            [
                'http_code' => $httpcode,
                'status' => 0,
                'status_updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );
        return false;
    }
}

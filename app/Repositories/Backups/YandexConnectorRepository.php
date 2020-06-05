<?php

namespace App\Repositories\Backups;

use App\Models\BackupYandexConnectors;
use App\Repositories\Repository;
use App\Models\BackupYandexConnectorsLogs;

/**
 * Class YandexConnectorsRepository.
 */
class YandexConnectorRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getList()
    {
        return BackupYandexConnectors::with('logs')->orderBy('id', 'desc')->get();
    }

    public function getPluckList()
    {
        return BackupYandexConnectors::pluck('description', 'id');
    }

    public function refresh($connectorId)
    {
        $connector = BackupYandexConnectors::find($connectorId);

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
                ]
            );

            BackupYandexConnectorsLogs::create(['connector_id' => $connector->id, 'status' => 1, 'resolved' => 1,]);

            return true;
        }

        BackupYandexConnectors::where('id', $connector->id)->update(
            [
                'http_code' => $httpcode,
                'status' => 0,
            ]
        );

        BackupYandexConnectorsLogs::create(['connector_id' => $connector->id, 'status' => 0, 'resolved' => 0,]);

        return false;
    }
}

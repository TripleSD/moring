<?php

namespace App\Repositories\Backups;

use App\Repositories\Repository;
use App\Models\BackupYandexConnectors;

/**
 * Class YandexTrashRepository
 * @package App\Repositories\Backups
 */
class YandexTrashRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getList()
    {
//        return BackupYandexConnectors::get();
    }

    /**
     * @param $request
     * @return bool
     */
    public function cleanTrash($request)
    {
        $connector = BackupYandexConnectors::find($request->id);

        $ch = curl_init('https://cloud-api.yandex.net/v1/disk/trash/resources/?path=');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: OAuth ' . $connector->token]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
        curl_close($ch);

        if ($httpcode !== 202) {
            return false;
        }

        return true;
    }
}

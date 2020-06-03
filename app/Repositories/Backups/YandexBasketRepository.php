<?php

namespace App\Repositories\Backups;

use App\Models\BackupYandexBaskets;
use App\Models\BackupYandexConnectors;
use App\Repositories\Repository;

/**
 * Class YandexBasketRepository.
 */
class YandexBasketRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getList()
    {
        return BackupYandexBaskets::with('connector')->get();
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
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
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

    /**
     * @param $request
     * @return mixed
     */
    public function getBasket($request)
    {
        return BackupYandexBaskets::find($request->id);
    }

    /**
     * @param $dataArray
     * @param $basketId
     * @return mixed
     */
    public function updateBasket($dataArray, $basketId)
    {
        return BackupYandexBaskets::where('id', $basketId)->update($dataArray);
    }
}

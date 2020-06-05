<?php

namespace App\Repositories\Backups;

use App\Models\BackupYandexBuckets;
use App\Models\BackupYandexConnectors;
use App\Repositories\Repository;

/**
 * Class YandexBucketsRepository.
 */
class YandexBucketsRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getList()
    {
        return BackupYandexBuckets::with('connector')->get();
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
    public function getBucket($request)
    {
        return BackupYandexBuckets::find($request->id);
    }

    /**
     * @param $dataArray
     * @param $bucketId
     * @return mixed
     */
    public function updateBucket($dataArray, $bucketId)
    {
        return BackupYandexBuckets::where('id', $bucketId)->update($dataArray);
    }
}

<?php

namespace App\Repositories\Backups;

use GuzzleHttp\Client;
use App\Models\BackupYandexBuckets;
use App\Models\BackupYandexConnectors;
use App\Repositories\Repository;

/**
 * Class YandexBucketsRepository.
 */
class YandexBucketsRepository extends Repository
{
    protected $service = 'Yandex Disk';

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
        $url       = 'https://cloud-api.yandex.net/v1/disk/trash/resources/?path=';

        $client = new Client();
        $res    = $client->delete(
            $url,
            [
                'headers' => [
                    "Authorization" => "OAuth $connector->token",
                ]
            ]
        );

        $status = json_decode($res->getBody(), true);

        if ($status === null) {
            $logController = new LogController();
            $logController->insert(
                $this->service,
                $res->getStatusCode(),
                "GET | true | $url",
                '1',
                \Route::getCurrentRoute()->getActionName()
            );

            return true;
        } else {
            $logController = new LogController();
            $logController->insert(
                $this->service,
                $res->getStatusCode(),
                "GET | false | $url",
                '1',
                \Route::getCurrentRoute()->getActionName()
            );

            return false;
        }
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

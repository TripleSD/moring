<?php

namespace App\Repositories\Backups;

use App\Helpers\SystemLog;
use App\Models\BackupYandexBuckets;
use App\Models\BackupYandexConnectors;
use App\Repositories\Repository;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class YandexBucketsRepository.
 */
class YandexBucketsRepository extends Repository
{
    private $BackupYandexBuckets;

    public function __construct()
    {
        $this->BackupYandexBuckets = new BackupYandexBuckets();
    }

    /**
     * @param $request
     * @return Builder[]|Collection
     */
    public function getList($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexBuckets::with(
            [
                'connector',
                'logs' => function ($q) {
                    return $q->where('resolved', 0);
                },
            ]
        )
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param $request
     * @return bool
     */
    public function cleanTrash($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        $connector = BackupYandexConnectors::find($request->id);
        $url       = 'https://cloud-api.yandex.net/v1/disk/trash/resources/?path=';

        $client = new Client();
        $res    = $client->delete(
            $url,
            [
                'headers' => [
                    'Authorization' => "OAuth $connector->token",
                ],
            ]
        );

        $status = json_decode($res->getBody(), true);

        if ($status === null) {
            // Insert event to system log
            SystemLog::createServiceEvent(
                __FUNCTION__,
                \Config::get('moring.service_yandex_disk'),
                $res->getStatusCode(),
                $request->method() . PHP_EOL . $url
            );

            return true;
        } else {
            // Insert event to system log
            SystemLog::createServiceEvent(
                __FUNCTION__,
                \Config::get('moring.service_yandex_disk'),
                $res->getStatusCode(),
                $request->method() . PHP_EOL . $url
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
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexBuckets::find($request->id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function updateBucket($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexBuckets::where('id', $request->id)->update($request->validated());
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createBucket($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexBuckets::create($request->validated());
    }

    /**
     * @param $request
     * @return mixed
     */
    public function destroyBucket($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexBuckets::where('id', $request->id)->delete();
    }
}

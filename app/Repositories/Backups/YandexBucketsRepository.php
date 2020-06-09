<?php

namespace App\Repositories\Backups;

use GuzzleHttp\Client;
use App\Models\BackupYandexBuckets;
use App\Models\BackupYandexConnectors;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\System\SystemLogRepository;

/**
 * Class YandexBucketsRepository.
 */
class YandexBucketsRepository extends Repository
{
    private $systemLog;
    private $BackupYandexBuckets;

    public function __construct()
    {
        $this->systemLog           = new SystemLogRepository();
        $this->BackupYandexBuckets = new BackupYandexBuckets();
    }

    /**
     * @param $request
     * @return Builder[]|Collection
     */
    public function getList($request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

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
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

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
            // Insert event to system log
            $this->systemLog->createServiceEvent(
                __FUNCTION__,
                \Config::get('moring.service_yandex_disk'),
                $res->getStatusCode(),
                $request->method() . PHP_EOL . $url
            );

            return true;
        } else {
            // Insert event to system log
            $this->systemLog->createServiceEvent(
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
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        return BackupYandexBuckets::find($request->id);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function updateBucket($request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        return BackupYandexBuckets::where('id', $request->id)->update($request->validated());
    }

    /**
     * @param $request
     * @return mixed
     */
    public function createBucket($request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        return BackupYandexBuckets::create($request->validated());
    }

    /**
     * @param $request
     * @return mixed
     */
    public function destroyBucket($request)
    {
        return BackupYandexBuckets::where('id', $request->id)->delete();
    }
}

<?php

namespace App\Repositories\Backups;

use App\Helpers\SystemLog;
use App\Models\BackupYandexBucketsLogs;
use App\Repositories\Repository;

/**
 * Class YandexBucketsRepository.
 */
class YandexBucketsLogsRepository extends Repository
{
    private $BackupYandexBucketsLogs;

    public function __construct()
    {
        $this->BackupYandexBucketsLogs = new BackupYandexBucketsLogs();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexBucketsLogs::where('status', 0)
            ->where('resolved', 0)
            ->orderBy('id', 'desc')
            ->limit('15')
            ->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getCount($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexBucketsLogs::where('status', 0)
            ->where('resolved', 0)
            ->count();
    }
}

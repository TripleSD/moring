<?php

namespace App\Repositories\Backups;

use App\Helpers\SystemLog;
use App\Models\BackupYandexTasksLogs;
use App\Repositories\Repository;

/**
 * Class YandexTasksLogsRepository.
 */
class YandexTasksLogsRepository extends Repository
{
    /**
     * @param $request
     * @return mixed
     */
    public function getList($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexTasksLogs::where('status', 0)
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

        return BackupYandexTasksLogs::where('status', 0)
            ->where('resolved', 0)
            ->count();
    }
}

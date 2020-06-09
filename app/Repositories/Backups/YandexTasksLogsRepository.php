<?php

namespace App\Repositories\Backups;

use App\Repositories\Repository;
use App\Models\BackupYandexTasksLogs;

/**
 * Class YandexTasksLogsRepository.
 */
class YandexTasksLogsRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getList()
    {
        return BackupYandexTasksLogs::where('status', 0)
            ->where('resolved', 0)
            ->orderBy('id', 'desc')
            ->limit('15')
            ->get();
    }

    public function getCount()
    {
        return BackupYandexTasksLogs::where('status', 0)
            ->where('resolved', 0)
            ->count();
    }
}

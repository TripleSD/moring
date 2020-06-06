<?php

namespace App\Repositories\Backups;

use App\Repositories\Repository;
use App\Models\BackupYandexConnectorsLogs;

/**
 * Class YandexConnectorsLogsRepository.
 */
class YandexConnectorsLogsRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getList()
    {
        return BackupYandexConnectorsLogs::where('status', 0)
            ->where('resolved', 0)
            ->orderBy('id', 'desc')
            ->limit('15')
            ->get();
    }
}

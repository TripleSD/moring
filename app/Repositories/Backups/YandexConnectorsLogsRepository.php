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
        return BackupYandexConnectorsLogs::orderBy('id')->limit('50')->get();
    }
}

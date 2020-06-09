<?php

namespace App\Repositories\Backups;

use App\Repositories\Repository;
use App\Models\BackupYandexBucketsLogs;
use App\Repositories\System\SystemLogRepository;

/**
 * Class YandexBucketsRepository.
 */
class YandexBucketsLogsRepository extends Repository
{
    private $systemLog;
    private $BackupYandexBucketsLogs;

    public function __construct()
    {
        $this->systemLog           = new SystemLogRepository();
        $this->BackupYandexBucketsLogs = new BackupYandexBucketsLogs();
    }

    /**
     * @return mixed
     */
    public function getList()
    {
        return BackupYandexBucketsLogs::where('status', 0)
            ->where('resolved', 0)
            ->orderBy('id', 'desc')
            ->limit('15')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return BackupYandexBucketsLogs::where('status', 0)
            ->where('resolved', 0)
            ->count();
    }
}

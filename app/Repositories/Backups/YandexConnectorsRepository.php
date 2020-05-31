<?php

namespace App\Repositories\Backups;

use App\Repositories\Repository;
use App\Models\BackupYandexConnectors;

/**
 * Class YandexConnectorsRepository
 * @package App\Repositories\Backups
 */
class YandexConnectorsRepository extends Repository
{
    /**
     * @return mixed
     */
    public function connectionsList()
    {
        return BackupYandexConnectors::get();
    }
}

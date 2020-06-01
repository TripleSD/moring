<?php

namespace App\Repositories\Backups;

use App\Repositories\Repository;
use App\Models\BackupYandexConnectors;

/**
 * Class YandexConnectorsRepository
 * @package App\Repositories\Backups
 */
class YandexConnectorRepository extends Repository
{
    /**
     * @return mixed
     */
    public function getList()
    {
        return BackupYandexConnectors::get();
    }
}

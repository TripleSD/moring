<?php

namespace App\Repositories\Backups;

use App\Repositories\Repository;
use App\Models\BackupYandexList;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BackupYandexRepository
 * @package App\Repositories\Backups
 */
class YandexTaskRepository extends Repository
{
    /**
     * @return Builder[]|Collection
     */
    public function getList()
    {
        return BackupYandexList::with(
                [
                    'logs' => function ($q) {
                        return $q->where('resolved', 0);
                    },
                ]
            )
            ->get();
    }
}

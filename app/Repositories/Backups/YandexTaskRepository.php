<?php

namespace App\Repositories\Backups;

use App\Models\BackupYandexTask;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BackupYandexRepository
 */
class YandexTaskRepository extends Repository
{
    /**
     * @return Builder[]|Collection
     */
    public function getList()
    {
        return BackupYandexTask::with(
            [
                'connector',
                'logs' => function ($q) {
                    return $q->where('resolved', 0);
                },
            ]
        )
            ->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getTask($request)
    {
        return BackupYandexTask::with('connector')->where('id', $request->id)->firstOrFail();
    }
}

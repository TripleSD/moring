<?php

namespace App\Repositories\Backups;

use App\Helpers\SystemLog;
use App\Models\BackupYandexTask;
use App\Repositories\Repository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class BackupYandexRepository.
 */
class YandexTaskRepository extends Repository
{
    /**
     * @param $request
     * @return Builder[]|Collection
     */
    public function getList($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexTask::with(
            [
                'connector',
                'logs' => function ($q) {
                    return $q->where('resolved', 0);
                },
            ]
        )
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * @param $request
     * @return mixed
     */
    public function getTask($request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        return BackupYandexTask::with('connector', 'active_logs')->where('id', $request->id)->firstOrFail();
    }
}

<?php

namespace App\Repositories\Backups;

use App\Models\BackupFtpList;
use App\Repositories\Repository;

class BackupFtpRepository extends Repository
{
    public function tasksList()
    {
        return BackupFtpList::with(
                [
                    'logs' => function ($q) {
                        return $q->where('resolved', 0);
                    },
                ]
            )
            ->get();
    }
}

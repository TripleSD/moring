<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class BackupYandexBuckets.
 */
class BackupYandexBuckets extends Model
{
    protected $table = 'backup_yandex_buckets';

    public function connector(): HasOne
    {
        return $this->HasOne(BackupYandexConnectors::class, 'id', 'connector_id');
    }
}
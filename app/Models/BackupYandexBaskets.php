<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class BackupYandexBaskets.
 */
class BackupYandexBaskets extends Model
{
    protected $table = 'backup_yandex_baskets';

    public function connector(): HasOne
    {
        return $this->HasOne(BackupYandexConnectors::class, 'id', 'connector_id');
    }
}

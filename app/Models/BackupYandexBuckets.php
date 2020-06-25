<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class BackupYandexBuckets.
 */
class BackupYandexBuckets extends Model
{
    protected $table = 'backup_yandex_buckets';

    protected $attributes = [
        'enabled' => 1,
    ];

    protected $fillable = ['connector_id', 'interval', 'enabled', 'description', 'comment'];

    public function logs(): HasMany
    {
        return $this->hasMany(BackupYandexBucketsLogs::class, 'bucket_id', 'id');
    }

    public function connector(): HasOne
    {
        return $this->HasOne(BackupYandexConnectors::class, 'id', 'connector_id');
    }

    public function getLastCheckAttribute()
    {
        if ($this->logs()->count() > 0) {
            return $this->logs()->orderBy('id', 'desc')->firstOrFail()->created_at;
        }

        return null;
    }

    /**
     * @return HasMany
     */
    public function active_logs()
    {
        return $this->logs()->where('resolved',0);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BackupYandexConnectors.
 */
class BackupYandexConnectors extends Model
{
    protected $table = 'backup_yandex_connectors';

    protected $attributes = [
        'status' => 1,
        'total_space' => 0,
        'used_space' => 0,
        'trash_size' => 0,
        'http_code' => 200,
    ];

    protected $fillable = [
        'description',
        'token',
        'comment',
        'status',
        'total_space',
        'used_space',
        'trash_size',
        'http_code',
    ];

    public function getPercentUsedAttribute()
    {
        if ($this->attributes['total_space'] > 0) {
            return round($this->attributes['used_space'] / $this->attributes['total_space'] * 100, 0);
        }

        return 0;
    }

    public function getPercentBucketUsedAttribute()
    {
        if ($this->attributes['total_space'] > 0) {
            return round($this->attributes['trash_size'] / $this->attributes['total_space'] * 100, 0);
        }

        return 0;
    }

    public function getTotalSpaceAttribute()
    {
        return round($this->attributes['total_space'] / 1024 / 1024 / 1024, 0);
    }

    public function getUsedSpaceAttribute()
    {
        return round($this->attributes['used_space'] / 1024 / 1024 / 1024, 0);
    }

    public function getTrashSizeAttribute()
    {
        return round($this->attributes['trash_size'] / 1024 / 1024 / 1024, 0);
    }

    public function logs()
    {
        return $this->hasMany(BackupYandexConnectorsLogs::class, 'connector_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BackupYandexConnectors
 * @package App\Models
 */
class BackupYandexConnectors extends Model
{
    protected $table = 'backup_yandex_connectors';

    protected $fillable = [
        'description',
        'token',
        'comment'
    ];

    public function getPercentUsedAttribute()
    {
        if ($this->attributes['total_space'] > 0) {
            return round($this->attributes['used_space'] / $this->attributes['total_space'] * 100, 0);
        }

        return 0;
    }
}

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
}

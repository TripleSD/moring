<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BackupYandexLogs
 * @package App\Models
 */
class BackupYandexLogs extends Model
{
    protected $table = 'backup_yandex_logs';

    protected $fillable = ['task_id', 'status', 'resolved'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BackupYandexTasksLogs
 * @package App\Models
 */
class BackupYandexTasksLogs extends Model
{
    protected $table = 'backup_yandex_tasks_logs';

    protected $fillable = ['task_id', 'status', 'resolved'];
}

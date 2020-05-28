<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BackupFtpLogs
 * @package App\Models
 */
class BackupFtpLogs extends Model
{
    protected $table = 'backup_ftp_logs';

    protected $fillable = ['task_id', 'status'];
}

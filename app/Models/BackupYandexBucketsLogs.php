<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BackupYandexBucketsLogs
 */
class BackupYandexBucketsLogs extends Model
{
    protected $table = 'backup_yandex_buckets_logs';

    protected $fillable = ['bucket_id', 'status', 'resolved'];
}

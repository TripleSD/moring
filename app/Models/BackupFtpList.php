<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class BackupFtpList
 * @package App\Models
 */
class BackupFtpList extends Model
{
    protected $table = 'backup_ftp_list';

    public function logs(): HasMany
    {
        return $this->hasMany(BackupFtpLogs::class,'task_id', 'id');
    }
}

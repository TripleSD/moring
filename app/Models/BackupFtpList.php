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

    protected $fillable = [
        'description',
        'hostname',
        'port',
        'folder',
        'pre',
        'post',
        'filename',
        'interval',
        'enabled'
    ];

    public function logs(): HasMany
    {
        return $this->hasMany(BackupFtpLogs::class, 'task_id', 'id');
    }

    public function getFullFilenameAttribute()
    {
        $filename = explode('.', $this->attributes['filename']);

        return $this->attributes['pre'] . $filename[0] . $this->attributes['post'] . '.' . $filename[1];
    }
}

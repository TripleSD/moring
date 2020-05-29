<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class BackupFtpList
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
        'enabled',
    ];

    public function logs(): HasMany
    {
        return $this->hasMany(BackupFtpLogs::class, 'task_id', 'id');
    }

    /**
     * @return string
     */
    public function getFullFilenameAttribute()
    {
        $this->attributes['pre'] = preg_replace('/%Y/', Carbon::now()->format('Y'), $this->attributes['pre']);
        $this->attributes['pre'] = preg_replace('/%m/', Carbon::now()->format('m'), $this->attributes['pre']);
        $this->attributes['pre'] = preg_replace('/%d/', Carbon::now()->format('d'), $this->attributes['pre']);

        $this->attributes['post'] = preg_replace('/%Y/', Carbon::now()->format('Y'), $this->attributes['post']);
        $this->attributes['post'] = preg_replace('/%m/', Carbon::now()->format('m'), $this->attributes['post']);
        $this->attributes['post'] = preg_replace('/%d/', Carbon::now()->format('d'), $this->attributes['post']);

        $filename = explode('.', $this->attributes['filename']);

        return $this->attributes['pre'] . $filename[0] . $this->attributes['post'] . '.' . $filename[1];
    }
}

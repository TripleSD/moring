<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SystemLogs.
 */
class SystemLogs extends Model
{
    protected $table = 'system_logs';

    protected $fillable = [
        'description',
        'debug_info',
    ];
}

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
        'service',
        'status',
        'debug_info',
        'user_id',
        'route',
        'callable_function'
    ];

    public function user()
    {
        return $this->hasOne(Users::class, 'id', 'user_id');
    }
}

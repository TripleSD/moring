<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
    protected $fillable = ['addr', 'description', 'api_token'];

    public function setAddrAttribute($ipAddr)
    {
        $this->attributes['addr'] = ip2long($ipAddr);
    }
}

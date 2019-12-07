<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServersPingResponses extends Model
{
    protected $fillable = ['server_id', 'first', 'second', 'third'];
}

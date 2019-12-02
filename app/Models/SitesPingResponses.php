<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SitesPingResponses extends Model
{
    protected $fillable = ['site_id', 'first', 'second', 'third'];

}

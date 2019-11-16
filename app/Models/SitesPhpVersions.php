<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SitesPhpVersions extends Model
{
    protected $fillable = ['site_id', 'php_version'];

}

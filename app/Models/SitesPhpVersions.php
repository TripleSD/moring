<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SitesPhpVersions extends Model
{
    protected $fillable = ['site_id', 'version', 'branch'];
}

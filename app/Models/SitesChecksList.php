<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SitesChecksList extends Model
{
    use SoftDeletes;

    protected $table = "sites_checks_list";
    protected $fillable = ['site_id', 'check_https', 'http_code', 'check_ssl', 'check_php', 'use_file'];

    public function site()
    {
        return $this->belongsTo(Sites::class,'site_id', 'id');
    }
}

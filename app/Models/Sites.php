<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sites extends Model
{
    protected $fillable = ['title', 'url', 'active', 'comment', 'file_url', 'https', 'enabled'];

    use SoftDeletes;

    public function checksList(){
        return $this->hasOne(SitesChecksList::class, 'site_id');
    }

    public function getPhpVersion()
    {
        return $this->hasOne(SitesPhpVersions::class,'site_id');
    }

    public function getHttpCode()
    {
        return $this->hasOne(SitesHttpCodes::class,'site_id');
    }

    public function getWebServer()
    {
        return $this->hasOne(SitesWebServers::class,'site_id');
    }

    public function getSslCertification()
    {
        return $this->hasOne(SitesSslCertificates::class,'site_id');
    }
}

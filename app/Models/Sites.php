<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sites extends Model
{
    protected $fillable = ['title', 'url', 'active', 'comment', 'file_url', 'https', 'enabled', 'pending'];

    use SoftDeletes;

    public function checksList() : HasOne
    {
        return $this->hasOne(SitesChecksList::class, 'site_id');
    }

    public function getPhpVersion(): HasOne
    {
        return $this->hasOne(SitesPhpVersions::class, 'site_id');
    }

    public function checkPhpEnabled(): HasOne
    {
        return $this->hasOne(SitesChecksList::class, 'site_id', 'id')->where('check_php', 1)->with('getPhpErrors');
    }

    public function getHttpCode(): HasOne
    {
        return $this->hasOne(SitesHttpCodes::class, 'site_id');
    }

    public function getWebServer(): HasOne
    {
        return $this->hasOne(SitesWebServers::class, 'site_id');
    }

    public function getSslCertification(): HasOne
    {
        return $this->hasOne(SitesChecksList::class, 'site_id')->where('check_ssl', 1)->with('getSSL');
    }

    public function getSitesPings(): HasOne
    {
        return $this->hasOne(SitesPingResponses::class, 'site_id');
    }
}

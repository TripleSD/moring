<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use function Faker\Provider\pt_BR\check_digit;

class SitesChecksList extends Model
{
    use SoftDeletes;

    protected $table = "sites_checks_list";
    protected $fillable = ['site_id', 'check_https', 'http_code', 'check_ssl', 'check_php', 'use_file'];

    public function site(): BelongsTo
    {
        return $this->belongsTo(Sites::class, 'site_id', 'id');
    }

    public function getPhpErrors(): hasOne
    {
        return $this->hasOne(SitesPhpVersions::class, 'site_id', 'site_id')->where('branch', 0);
    }

    public function getSSL(): hasOne
    {
        return $this->hasOne(SitesSslCertificates::class, 'site_id', 'site_id');
    }
}

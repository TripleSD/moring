<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SitesSslCertificates extends Model
{
    protected $fillable = [
        'site_id',
        'issuer',
        'valid_status',
        'expiration_date',
        'expiration_days',
        'algorithm',
        'from_date'
    ];
}

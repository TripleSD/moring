<?php

namespace App\Repositories\Sites;

use App\Repositories\Repository;
use Illuminate\Support\Facades\Artisan;

class SitesBackendRepository extends Repository
{
    public function refreshList()
    {
        Artisan::call('SitesChecker');
        Artisan::call('SitesSSLChecker');
    }
}

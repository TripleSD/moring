<?php

namespace App\Repositories\Sites;

use App\Repositories\Repository;
use Illuminate\Support\Facades\Artisan;

class BackendSitesRepository extends Repository
{
    public function refreshList()
    {
        Artisan::call('SitesChecker');
        return redirect()->route('admin.sites.index');
    }

}
<?php

namespace App\Repositories\Sites;

use App\Console\Commands\SitesChecker;
use App\Console\Commands\SitesSSLChecker;
use App\Repositories\Repository;

class SitesBackendRepository extends Repository
{
    public function refreshList()
    {
        $siteChecker = new SitesChecker();
        $siteChecker->handle(null, 'web');

        $siteSslChecker = new SitesSSLChecker();
        $siteSslChecker->handle();
    }
}

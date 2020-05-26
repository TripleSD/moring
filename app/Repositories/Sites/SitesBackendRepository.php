<?php

namespace App\Repositories\Sites;

use App\Repositories\Repository;
use App\Console\Commands\SitesChecker;
use App\Console\Commands\SitesSSLChecker;

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

<?php

namespace App\Http\Controllers\Admin\Sites;

use App\Http\Controllers\Controller;
use App\Repositories\Sites\SitesBackendRepository;

class SitesBackendController extends Controller
{
    public function refreshList(SitesBackendRepository $sitesBackendRepository)
    {
        return $sitesBackendRepository->refreshList();
    }
}

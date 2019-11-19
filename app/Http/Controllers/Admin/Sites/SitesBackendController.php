<?php

namespace App\Http\Controllers\Admin\Sites;

use App\Http\Controllers\Controller;
use App\Repositories\Sites\BackendSitesRepository;

class SitesBackendController extends Controller
{
    public function refreshList(BackendSitesRepository $backendSitesRepository)
    {
        return $backendSitesRepository->refreshList();
    }
}

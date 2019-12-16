<?php

namespace App\Http\Controllers;

use App\Repositories\CheckSitesRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class ChecksSitesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param CheckSitesRepository $checkSitesRepository
     * @return Factory|View
     */
    public function getIndex(CheckSitesRepository $checkSitesRepository)
    {
        $sites = $checkSitesRepository->getList();

        return view('sites', compact('sites'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Repositories\CheckSitesRepository;

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
     * @param CheckSitesRepository $repository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View*
     */
    public function getIndex(CheckSitesRepository $checkSitesRepository)
    {
        $sites = $checkSitesRepository->getList();
        return view('sites',compact('sites'));
    }
}
    
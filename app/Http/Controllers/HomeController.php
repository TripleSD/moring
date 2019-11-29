<?php

namespace App\Http\Controllers;

use App\Repositories\AdminSitesRepository;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(AdminSitesRepository $adminSiteRepository)
    {
        $sites = $adminSiteRepository->sortedList(4, 'desc');
        return view('home', compact('sites'));
    }
}

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
        $sites = $adminSiteRepository->sortedList(5, 'desc');
        $pingData = $adminSiteRepository->getNewSites(5);

        $pings = json_encode( array_map(function($item) use (&$pings){
            return $item['ping'];
        }, $pingData));

        $titles = json_encode( array_map(function($item) use (&$titles){
            return $item['title'];
        }, $pingData));

        $servers = json_encode($adminSiteRepository->getWebServersForNew(5)->keys());
        $counts = json_encode(array_values($adminSiteRepository->getWebServersForNew(5)->toArray()));

        return view('home', compact('sites', 'pings', 'titles', 'servers', 'counts'));
    }
}

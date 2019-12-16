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
        $pingData =  $sites->map(function($item){
            return $item->getNewSitePing->average;
        });
        $pings = json_encode($pingData);

        $titlesData = $sites->map(function($item) use (&$titles){
            return $item->title;
        });
        $titles = json_encode($titlesData);

        $servers = json_encode($adminSiteRepository->getWebServersForNew(5)->keys());
        $counts = json_encode(array_values($adminSiteRepository->getWebServersForNew(5)->toArray()));

        return view('home', compact('sites', 'pings', 'titles', 'servers', 'counts'));
    }
}

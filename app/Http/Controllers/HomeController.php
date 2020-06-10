<?php

namespace App\Http\Controllers;

use App\Repositories\AdminSitesRepository;
use App\Repositories\ItemsSortRepository;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;

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
     * @param AdminSitesRepository $adminSiteRepository
     * @return Renderable
     */
    public function index(AdminSitesRepository $adminSiteRepository)
    {
        $sites    = $adminSiteRepository->sortedList(5, 'desc');
        $pingData = $sites->map(
            function ($item) {
                return $item->getNewSitePing->average;
            }
        );
        $pings    = json_encode($pingData);

        $titlesData = $sites->map(
            function ($item) use (&$titles) {
                return $item->title;
            }
        );
        $titles     = json_encode($titlesData);

        $servers = json_encode($adminSiteRepository->getWebServersForNew(5)->keys());
        $counts  = json_encode(array_values($adminSiteRepository->getWebServersForNew(5)->toArray()));
        $user    = Auth::user();
        $sort    = (new ItemsSortRepository())->sortedList($user);

        return view('home', compact('sites', 'pings', 'titles', 'servers', 'counts', 'sort'));
    }
}

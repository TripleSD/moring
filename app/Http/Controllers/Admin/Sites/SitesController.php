<?php

namespace App\Http\Controllers\Admin\Sites;

use App\Console\Commands\SitesChecker;
use App\Console\Commands\SitesPings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sites\ShowSitesRequest;
use App\Http\Requests\Sites\StoreSiteRequest;
use App\Http\Requests\Sites\UpdateSiteRequest;
use App\Models\BridgePhpVersions;
use App\Repositories\AdminSitesRepository;
use App\Repositories\Sites\SitesCountsRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AdminSitesRepository $adminSiteRepository
     * @param SitesCountsRepository $sitesCountsRepository
     * @param Request $request
     * @return Factory|View
     */
    public function index(
        AdminSitesRepository $adminSiteRepository,
        SitesCountsRepository $sitesCountsRepository,
        Request $request
    ) {
        $sites = $adminSiteRepository->index($request);
        //TODO вынести в репозиторий два запроса
        $bridgeBranchVersion = BridgePhpVersions::pluck('branch')->toArray();
        $bridgePhpVersion = BridgePhpVersions::get();

        // Counts
        $counts['allSites'] = $sitesCountsRepository->getAllSitesCount() ?: []; // Ok
        $counts['sslExpirationsDaysSites'] = $sitesCountsRepository->getSslExpirationsDaysSitesCount() ?: [];
        $counts['sslErrorsSites'] = $sitesCountsRepository->getSslErrorsSitesCount() ?: [];  // OK
        $counts['sslSuccessSites'] = $sitesCountsRepository->getSslSuccessSitesCount() ?: [];  //Ok
        $counts['softwareErrorsSites'] = $sitesCountsRepository->getSoftwareErrorsSitesCount() ?: [];  // Ok
        $counts['bridgeErrors'] = $sitesCountsRepository->getBridgeErrors() ?: [];
        $counts['softwareVersionErrors'] = $sitesCountsRepository->getSoftwareVersionErrors() ?: [];
        $counts['disabledSites'] = ($sitesCountsRepository->getDisabledSitesCount()) ?: [];  // Ok

        $keys = $request->keys();
        if (! empty($keys)) {
            $key = $keys[0];
            if (array_key_exists($key, $counts)) {
                if (! empty($counts[$key])) {
                    $sites = $counts[$key];
                } else {
                    $sites = [];
                }
            }
        }

        return view(
            'admin.sites.index',
            compact(
                'sites',
                'bridgePhpVersion',
                'bridgeBranchVersion',
                'counts'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreSiteRequest $request
     * @return RedirectResponse
     */
    public function store(StoreSiteRequest $request)
    {
        $fillable = $request->validated();

        // Checking DNS resolve by domains
        if (checkdnsrr($fillable['url'], 'A')) {
            $result = (new AdminSitesRepository())->store($fillable);
            if ($result) {
                // Run first site check
                $check = new SitesChecker();
                $check->handle((int) ($result->id));

                // Run first site ping as well
                $ping = new SitesPings();
                $ping->handle(intval($result->id));

                flash('Запись добавлена')->success();

                return redirect()->route('admin.sites.index');
            } else {
                return back()->withInput();
            }
        } else {
            flash('Запись не добавлена. Проверьте существование домена.')->warning();

            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     * @param ShowSitesRequest $request
     * @param AdminSitesRepository $adminSiteRepository
     * @return Factory|View
     */
    public function show(ShowSitesRequest $request, AdminSitesRepository $adminSiteRepository)
    {
        //TODO вынести в репозиторий два запроса
        $bridgeBranchVersion = BridgePhpVersions::pluck('branch')->toArray();
        $bridgePhpVersion = BridgePhpVersions::get();

        $pings = $adminSiteRepository->listOfPings($request, 50);

        $averages = json_encode(
            $pings->map(
                function ($ins) {
                    return $ins->average;
                }
            )
        );

        $time = json_encode(
            $pings->map(
                function ($ins) {
                    return $ins->created_at;
                }
            )
        );

        $site = $adminSiteRepository->show($request);

        return view('admin.sites.show', compact('site', 'bridgeBranchVersion', 'bridgePhpVersion', 'averages', 'time'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param ShowSitesRequest $request
     * @param AdminSitesRepository $adminSitesRepository
     * @return Factory|View
     */
    public function edit(ShowSitesRequest $request, AdminSitesRepository $adminSitesRepository)
    {
        $site = $adminSitesRepository->show($request);

        return view('admin.sites.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateSiteRequest $request
     * @param AdminSitesRepository $adminSitesRepository
     * @return RedirectResponse
     */
    public function update(UpdateSiteRequest $request, AdminSitesRepository $adminSitesRepository)
    {
        $id = $request->id;
        $fillable = $request->validated();
        $result = $adminSitesRepository->update($fillable, $id);
        if (! $result) {
            return back()->withInput($fillable);
        } else {
            $check = new SitesChecker();
            $check->handle($id);
            flash('Запись обновлена')->success();

            return redirect()->route('admin.sites.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @param AdminSitesRepository $adminSitesRepository
     * @return RedirectResponse
     */
    public function destroy($id, AdminSitesRepository $adminSitesRepository)
    {
        $result = $adminSitesRepository->destroy($id);
        if (! $result) {
            return back()
                ->withInput();
        } else {
            flash('Сайт удален из списка мониторинга')->success();

            return redirect()->route('admin.sites.index');
        }
    }

    public function refresh($id, AdminSitesRepository $adminSitesRepository)
    {
        $check = new SitesChecker($id);
        $check->handle($id);

        $ping = new SitesPings();
        $ping->handle($id);
        if ($check) {
            flash('Данные обновлены')->success();
        } else {
            flash('Что-то пошло не так...');
        }

        return back();
    }

    public function switchOnOff(int $id, int $on, AdminSitesRepository $adminSitesRepository)
    {
        $request = ['id' => $id, 'on' => $on];

        $switch = $adminSitesRepository->switch($request);
        if ($switch) {
            flash('Данные обновлены')->success();
        } else {
            flash('Что-то пошло не так...');
        }

        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin\Sites;

use App\Console\Commands\SitesChecker;
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
        $counts['allSitesCount'] = $sitesCountsRepository->getAllSitesCount();
        $counts['disabledSitesCount'] = $sitesCountsRepository->getDisabledSitesCount();
        $counts['sslExpirationsDaysSitesCount'] = $sitesCountsRepository->getSslExpirationsDaysSitesCount();
        $counts['sslErrorsSitesCount'] = $sitesCountsRepository->getSslErrorsSitesCount();
        $counts['sslSuccessSitesCount'] = $sitesCountsRepository->getSslSuccessSitesCount();
        $counts['softwareErrorsSitesCount'] = $sitesCountsRepository->getSoftwareErrorsSitesCount();
        $counts['bridgeErrors'] = $sitesCountsRepository->getBridgeErrors();
        $counts['softwareVersionErrors'] = $sitesCountsRepository->getSoftwareVersionErrors();


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
                $check = new SitesChecker();
                $check->handle();
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

        $site = $adminSiteRepository->show($request);
        return view('admin.sites.show', compact('site', 'bridgeBranchVersion', 'bridgePhpVersion'));
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
        if (!$result) {
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
        if (!$result) {
            return back()
                ->withInput();
        } else {
            flash('Сайт удален из списка мониторинга')->success();
            return redirect()->route('admin.sites.index');
        }
    }
}

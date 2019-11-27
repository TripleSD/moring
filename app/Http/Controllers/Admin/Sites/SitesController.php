<?php

namespace App\Http\Controllers\Admin\Sites;

use App\Console\Commands\SitesChecker;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sites\ShowSitesRequest;
use App\Http\Requests\Sites\StoreSiteRequest;
use App\Http\Requests\Sites\UpdateSiteRequest;
use App\Models\BridgePhpVersions;
use App\Repositories\AdminSitesRepository;
use Illuminate\Http\Request;


class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminSitesRepository $adminSiteRepository, Request $request)
    {
        $sites = $adminSiteRepository->index($request);

        //TODO вынести в репозиторий два запроса
        $bridgeBranchVersion = BridgePhpVersions::pluck('branch')->toArray();
        $bridgePhpVersion = BridgePhpVersions::get();
        return view('admin.sites.index', compact('sites','bridgePhpVersion','bridgeBranchVersion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sites.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiteRequest $request)
    {
        $fillable = $request->validated();
        $result = (new AdminSitesRepository())->store($fillable);
        if($result) {
            $check = new SitesChecker();
            $check->handle();
            flash('Запись добавлена')->success();
            return redirect()
                ->route('admin.sites.index');
        } else {
            return back()
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShowSitesRequest $request, AdminSitesRepository $adminSitesRepository)
    {
        $site = $adminSitesRepository->show($request);
        return view('admin.sites.edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, AdminSitesRepository $adminSitesRepository)
    {
        $result = $adminSitesRepository->destroy($id);
        if(!$result){
            return back()
                ->withInput();
        } else {
            flash('Сайт удален из списка мониторинга')->success();
            return redirect()->route('admin.sites.index');
        }
    }
}

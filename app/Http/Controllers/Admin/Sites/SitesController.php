<?php

namespace App\Http\Controllers\Admin\Sites;

use App\Console\Commands\SitesChecker;
use App\Console\Commands\SitesPings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Sites\ShowSitesRequest;
use App\Http\Requests\Sites\StoreSiteRequest;
use App\Http\Requests\Sites\UpdateSiteRequest;
use App\Models\BridgePhpVersions;
use App\Models\Sites;
use App\Repositories\AdminSitesRepository;
use App\Repositories\Sites\SitesCountsRepository;
use Carbon\Carbon;
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
        //TODO вынести в репозиторий запрос
        $bridgePhpVersion = BridgePhpVersions::select('version', 'branch', 'deprecated_status')
            ->orderBy('version')
            ->get();

        // Counts
        $counts['allSites']                = $sitesCountsRepository->getAllSitesCount() ?: []; // Ok
        $counts['sslExpirationsDaysSites'] = $sitesCountsRepository->getSslExpirationsDaysSitesCount() ?: [];
        $counts['sslErrorsSites']          = $sitesCountsRepository->getSslErrorsSitesCount() ?: [];            // OK
        $counts['sslSuccessSites']         = $sitesCountsRepository->getSslSuccessSitesCount() ?: [];           //Ok
        $counts['softwareErrorsSites']     = $sitesCountsRepository->getSoftwareErrorsSitesCount() ?: [];       // Ok
        $counts['bridgeErrors']            = $sitesCountsRepository->getBridgeErrors() ?: [];
        $counts['disabledSites']           = ($sitesCountsRepository->getDisabledSitesCount()) ?: [];         // Ok
        $counts['deprecatedPHPVersion']    = ($sitesCountsRepository->getDeprecatedVersions()) ?: [];         // Ok

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
     * @param AdminSitesRepository $adminSitesRepository
     * @return RedirectResponse
     */
    public function store(StoreSiteRequest $request, AdminSitesRepository $adminSitesRepository)
    {
        // Checking domain DNS Resolve
        // Create data array for check
        // Check default value
        // Check full check url
        // Storing data
        // Site check
        // Site pings

        // Checking domain DNS resolve
        if ($adminSitesRepository->checkErrorDnsDomain($request)) {
            flash('Запись не добавлена. Проверьте существование домена.')->warning();

            return redirect()->back()->withInput();
        }

        // Create data array for check
        $site = $this->createDataArray($request);

        // Check default value
        (isset($request->use_file)) ? $request->use_file = 1 : $request->use_file = 0;

        // Check full check url
        if ($request->use_file && ! $adminSitesRepository->checkUrl($site)) {
            flash('Проверьте имя сайта/имя Moring файла/настройки HTTPS.')->warning();

            return redirect()->back()->withInput();
        }

        // Storing data
        $site = $adminSitesRepository->store($request->validated());

        // Site check
        $this->checkSite($site->site_id);

        // Site pings
        $this->pingSite($site->site_id);

        flash('Запись добавлена')->success();

        return redirect()->route('admin.sites.index');
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
        $bridgePhpVersion    = BridgePhpVersions::get();

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
                    return date('Y-m-d H:i:s', strtotime($ins->created_at));
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
        // Create data array for check
        // Check default value
        // Check full check url
        // Storing data
        // Site check

        // Create data array for check
        $site = $this->createDataArray($request);

        // Check default value
        (isset($request->use_file)) ? $request->use_file = 1 : $request->use_file = 0;

        // Check full check url
        if ($request->use_file && ! $adminSitesRepository->checkUrl($site)) {
            flash('Проверьте имя сайта/имя Moring файла/настройки HTTPS.')->warning();

            return redirect()->back()->withInput();
        }

        // Storing data
        $adminSitesRepository->update($request->validated(), $request->id);

        // Site check
        $this->checkSite($request->id);

        flash('Запись обновлена')->success();

        return redirect()->route('admin.sites.index');
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

    public function refresh($id)
    {
        // TODO - проверить нужно определять локаль
        try {
            // Getting current locale.
            if (session()->has('locale')) {
                $locale = session()->get('locale');
            } else {
                $locale = 'en';
            }

            // Getting current time.
            $startTime = Carbon::now();

            $site = Sites::find($id);
            $site->update(['ip_address' => gethostbyname($site->url)]);

            // Starting checks
            $this->checkSite($id);
            $this->pingSite($id);

            // Getting current time for compare.
            $endTime = Carbon::now()->locale($locale);

            // Comparing start & end time (humans view).
            $diffTime = $endTime->diffForHumans($startTime);

            flash(trans('messages.flash.success') . " ($diffTime) ")->success();

            return back();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();

            return redirect()->route('admin.sites.index');
        }
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

    /**
     * @param $request
     * @return array
     */
    private function createDataArray($request)
    {
        return ['url' => $request->url, 'file_url' => $request->file_url, 'https' => $request->https];
    }

    private function checkSite($siteId)
    {
        $check = new SitesChecker();
        $check->handle($siteId, 'web');

        return true;
    }

    private function pingSite($siteId)
    {
        $ping = new SitesPings();
        $ping->handle($siteId);

        return true;
    }
}

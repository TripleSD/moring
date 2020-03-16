<?php

namespace App\Http\Controllers\Admin\Sites;

use App\Http\Controllers\Controller;
use App\Repositories\Sites\SitesBackendRepository;
use Carbon\Carbon;

class SitesBackendController extends Controller
{
    public function refreshList(SitesBackendRepository $sitesBackendRepository)
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

            // Starting checks
            $sitesBackendRepository->refreshList();

            // Getting current time for compare.
            $endTime = Carbon::now()->locale($locale);

            // Comparing start & end time (humans view).
            $diffTime = $endTime->diffForHumans($startTime);

            flash(trans('messages.flash.success') . " ($diffTime) ")->success();

            return redirect()->route('admin.sites.index');
        } catch (\Exception $e) {
            flash($e->getMessage())->error();

            return redirect()->route('admin.sites.index');
        }
    }
}

<?php

namespace App\Http\Controllers\Api\Sites;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Sites;
use App\Models\SitesSslCertificates;
use Illuminate\Http\Request;

class SslController extends Controller
{
    public function index()
    {
        return 'OK';
    }

    public function search()
    {
        return \Response::json(Sites::where('https', 1)->pluck('title'));
    }

    public function query(Request $request)
    {
        $arr_r   = [];
        $targets = $request->input('targets');

        foreach ($targets as $key => $target) {
            $url    = $target['target'];
            $site   = Sites::where('url', $target)->first();
            $values = SitesSslCertificates::where('site_id', $site->id)->get();

            $arr['target']     = $url;
            $arr['datapoints'] = [];

            $arr_count = 0;

            foreach ($values as $key => $value) {
                $arr['datapoints'][$arr_count] = [$value->expiration_days, Carbon::now()->getPreciseTimestamp(3)];
                $arr_count++;
            }

            $arr_r[] = $arr;
        }

        return \Response::json($arr_r);
    }
}

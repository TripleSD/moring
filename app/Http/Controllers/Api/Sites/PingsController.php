<?php

namespace App\Http\Controllers\Api\Sites;

use App\Http\Controllers\Controller;
use App\Models\Sites;
use App\Models\SitesPingResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PingsController extends Controller
{
    public function index()
    {
        return 'OK';
    }

    public function search()
    {
        return \Response::json(Sites::pluck('title'));
    }

    public function query(Request $request)
    {
        $arr_r     = [];
        $targets   = $request->input('targets');
        $range     = $request->input('range');
        $startTime = Carbon::parse($range['from'])->addHours(3);
        $endTime   = Carbon::parse($range['to'])->addHours(3);

        foreach ($targets as $key => $target) {
            $url               = $target['target'];
            $site              = Sites::where('url', $target)->first();
            $values            = SitesPingResponses::where('site_id', $site->id)
                ->whereBetween('created_at', [$startTime, $endTime])
                ->get();

            $arr['target']     = $url;
            $arr['datapoints'] = [];

            $arr_count         = 0;

            foreach ($values as $key => $value) {
                $arr['datapoints'][$arr_count] = [
                    $value->average,
                    Carbon::parse($value->created_at)->getPreciseTimestamp(3)
                ];
                $arr_count++;
            }

            $arr_r[] = $arr;
        }

        return \Response::json($arr_r);
    }
}

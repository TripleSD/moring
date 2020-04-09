<?php

namespace App\Http\Controllers\Api;

use App\Models\Sites;
use App\Models\SitesPingResponses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ApiController extends Controller
{
    public function index()
    {
        return "OK";
    }

    public function search(Request $request)
    {
        file_put_contents('search.tmp',$request);
        return \Response::json(Sites::pluck('title'));
    }

    public function query(Request $request)
    {

        $arr_r = [];
        $targets = $request->input('targets');
        $range = $request->input('range');
        $startTime = Carbon::parse($range['from'])->addHours(3);
        $endTime = Carbon::parse($range['to'])->addHours(3);

        foreach($targets as $key => $target) {
            $url = $target['target'];
            $site = Sites::where('url',$target)->first();
            $values = SitesPingResponses::where('site_id',$site->id)
                ->whereBetween('created_at', array($startTime, $endTime))
                ->get();
            $arr['target'] = $url;
            $arr['datapoints'] = [];

            foreach($values as $key=>$value) {
                array_push($arr['datapoints'], [$value->average, Carbon::parse($value->created_at)->getPreciseTimestamp(3)]);
            }

            $arr_r[] = $arr;
        }

        return \Response::json($arr_r);
    }
}

<?php

namespace App\Http\Controllers\Api\Sites;

use App\Http\Controllers\Controller;
use App\Models\Sites;
use App\Models\SitesPingResponses;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SslController extends Controller
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

    }
}

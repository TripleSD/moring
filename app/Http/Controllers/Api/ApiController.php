<?php

namespace App\Http\Controllers\Api;

use App\Models\Sites;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getPingJson()
    {
        return \Response::json(Sites::with('getSitesPings')->get());
    }
}

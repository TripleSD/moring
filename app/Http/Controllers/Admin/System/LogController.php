<?php

namespace App\Http\Controllers\Admin\System;

use App\Models\SystemLogs;
use App\Http\Controllers\Controller;

/**
 * Class LogController
 */
class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function insert($service, $status, $debugInfo, $user_id)
    {
        SystemLogs::create(
            [
                'service' => $service,
                'status' => $status,
                'debug_info' => $debugInfo,
                'user_id' => $user_id,
            ]
        );

        return true;
    }
}

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

    public function insert($message, $debugInfo)
    {
        SystemLogs::create(
            [
                'description' => $message,
                'debug_info' => $debugInfo,
            ]
        );

        return true;
    }
}

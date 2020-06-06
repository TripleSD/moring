<?php

namespace App\Http\Controllers\Admin\System;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class LogMakerEventController.
 */
class LogMakerEventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @param null $service
     * @param null $debugInfo
     * @param null $status
     * @return array
     */
    public function makeLog(Request $request, $service = null, $debugInfo = null, $status = null)
    {
        if ($service === null) {
            $service = \Config::get('moring.service_user');
        }

        if ($service === 'mysql') {
            $service = \Config::get('moring.service_mysql');
        }

        if ($debugInfo === null) {
            $debugInfo = $request->method();
        }

        if ($status === null) {
            $status = $request->server('REDIRECT_STATUS');
        }

        return [
            'service' => $service,
            'status' => $status,
            'debug_info' => $debugInfo,
            'user_id' => \Auth::user()->id,
            'route' => \Route::getCurrentRoute()->getActionName(),
        ];
    }
}

<?php

namespace App\Repositories\System;

use App\Models\SystemLogs;
use App\Repositories\Repository;

/**
 * Class SystemLogRepository.
 * @package App\Repositories\System
 */
class SystemLogRepository extends Repository
{
    /**
     * @param $request
     * @return mixed
     */
    public function createUserEvent($request)
    {
        $logArray = [
            'service' => \Config::get('moring.service_user'),
            'debug_info' => $request->method(),
            'status' => $request->server('REDIRECT_STATUS'),
            'user_id' => \Auth::user()->id,
            'route' => \Route::getCurrentRoute()->getActionName(),
        ];

        return SystemLogs::create($logArray);
    }

    /**
     * @param null $service
     * @param null $status
     * @param null $debugInfo
     * @return mixed
     */
    public function createServiceEvent($service = null, $status = null, $debugInfo = null)
    {
        if ($service === 'mysql') {
            $service = \Config::get('moring.service_mysql');
        }

        $logArray = [
            'service' => $service,
            'debug_info' => $debugInfo,
            'status' => $status,
            'user_id' => \Auth::user()->id,
            'route' => \Route::getCurrentRoute()->getActionName(),
        ];

        return SystemLogs::create($logArray);
    }
}

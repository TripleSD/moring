<?php

namespace App\Helpers;

use App\Models\SystemLogs;

/**
 * Class SystemLog.
 */
class SystemLog
{
    /**
     * @param $functionName
     * @param $request
     * @return mixed
     */
    public static function createUserEvent($functionName, $request)
    {
        $logArray = [
            'service' => \Config::get('moring.service_system'),
            'debug_info' => $request->method(),
            'status' => $request->server('REDIRECT_STATUS'),
            'user_id' => \Auth::user()->id,
            'route' => \Route::getCurrentRoute()->getActionName() . PHP_EOL,
            'callable_function' => $functionName
        ];

        return SystemLogs::create($logArray);
    }

    /**
     * @param $functionName
     * @param null $service
     * @param null $status
     * @param null $debugInfo
     * @return mixed
     */
    public static function createServiceEvent($functionName, $service = null, $status = null, $debugInfo = null)
    {
        if ($service === 'mysql') {
            $service = \Config::get('moring.service_mysql');
        }

        $logArray = [
            'service' => $service,
            'debug_info' => $debugInfo,
            'status' => $status,
            'user_id' => \Auth::user()->id,
            'route' => \Route::getCurrentRoute()->getActionName() . PHP_EOL,
            'callable_function' => $functionName
        ];

        return SystemLogs::create($logArray);
    }
}

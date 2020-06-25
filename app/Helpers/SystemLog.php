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
        if (isset(\Auth::user()->id)) {
            $userId = \Auth::user()->id;
        } else {
            $userId = 0;
        }

        $logArray = [
            'service' => \Config::get('moring.service_system'),
            'debug_info' => $request->method(),
            'status' => $request->server('REDIRECT_STATUS'),
            'user_id' => $userId,
            'route' => \Route::getCurrentRoute()->getActionName() . PHP_EOL,
            'callable_function' => $functionName,
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
        if (isset(\Auth::user()->id)) {
            $userId = \Auth::user()->id;
        } else {
            $userId = 0;
        }

        if ($service === 'mysql') {
            $service = \Config::get('moring.service_mysql');
        }

        $logArray = [
            'service' => $service,
            'debug_info' => $debugInfo,
            'status' => $status,
            'user_id' => $userId,
            'route' => \Route::getCurrentRoute()->getActionName() . PHP_EOL,
            'callable_function' => $functionName,
        ];

        return SystemLogs::create($logArray);
    }
}

<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\Bridge\BridgeController;
use Closure;
use Illuminate\Support\Facades\View;

class MoringBridgeInfo
{
    public function handle($request, Closure $next)
    {
        $bridge = new BridgeController();
        View::share('bridgeInfo',$bridge->getInfo());
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\Bridge\BridgeController;
use Closure;
use Illuminate\Support\Facades\View;

class MoringBridgeInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $bridge = new BridgeController();
        View::share('bridgeInfo',$bridge->getInfo());

        return $next($request);
    }
}

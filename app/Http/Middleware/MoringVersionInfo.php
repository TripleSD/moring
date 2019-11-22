<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\Moring\MoringController;
use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class MoringVersionInfo
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
        $latestVersion = new MoringController();
        $latestVersion = $latestVersion->getInfo();
        View::share('latestMoringVersion',$latestVersion['currentVersion']);
        View::share('latestHumanMoringVersion',$latestVersion['currentHumanVersion']);
        $currentVersion = Config::get('moring.version');
        $currentHumanVersion = Config::get('moring.humanVersion');
        View::share('currentMoringVersion',$currentVersion);
        View::share('currentHumanMoringVersion',$currentHumanVersion);
        return $next($request);
    }
}

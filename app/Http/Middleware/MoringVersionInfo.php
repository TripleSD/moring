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
        $versions = new MoringController();
        $versions = $versions->getInfo();
        View::share('latestVersion',$versions['currentVersion']);
        View::share('latestHumanVersion',$versions['currentHumanVersion']);
        $currentVersion = Config::get('moring.version');
        $currentHumanVersion = Config::get('moring.humanVersion');
        View::share('currentVersion',$currentVersion);
        View::share('currentHumanVersion',$currentHumanVersion);
        return $next($request);
    }
}

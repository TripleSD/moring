<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Admin\Moring\MoringController;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;

class MoringVersionInfo
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $builds = new MoringController();
        $builds = $builds->getInfo();
        View::share('latestBuild', $builds['latestBuild']);
        View::share('latestBuildDate', Carbon::parse($builds['latestBuildDate'])->format('d-m-Y'));
        $currentBuild = Config::get('moring.build');
        View::share('currentBuild', $currentBuild);

        return $next($request);
    }
}

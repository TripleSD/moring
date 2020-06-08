<?php

namespace App\Http\Middleware;

use Carbon\CarbonInterface;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\View;
use App\Repositories\Backups\YandexConnectorsLogsRepository;

/**
 * Class HeaderCounts.
 */
class HeaderCounts
{
    private $YandexConnectorsLogsRepository;

    public function __construct()
    {
        $this->YandexConnectorsLogsRepository = new YandexConnectorsLogsRepository();
    }

    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $yandexConnectorsLogsCount = $this->YandexConnectorsLogsRepository->getCount();
        $yandexConnectorsLastEvent = $this->YandexConnectorsLogsRepository->getList();
        if ($yandexConnectorsLastEvent->count() > 0) {
            $yandexConnectorsLogsLastEvent = Carbon::parse(
                $yandexConnectorsLastEvent->last()->created_at
            )->diffForHumans(
                Carbon::now(),
                ['syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW]
            );
        } else {
            $yandexConnectorsLogsLastEvent = null;
        }

        $totalCount = $yandexConnectorsLogsCount;

        View::share('yandexConnectorsLogsCount', $yandexConnectorsLogsCount);
        View::share('yandexConnectorsLogsLastEvent', $yandexConnectorsLogsLastEvent);
        View::share('totalCount', $totalCount);

        return $next($request);
    }
}

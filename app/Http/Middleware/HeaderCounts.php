<?php

namespace App\Http\Middleware;

use Carbon\CarbonInterface;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\View;
use App\Repositories\Backups\YandexTasksLogsRepository;
use App\Repositories\Backups\YandexBucketsLogsRepository;
use App\Repositories\Backups\YandexConnectorsLogsRepository;

/**
 * Class HeaderCounts.
 */
class HeaderCounts
{
    private $YandexConnectorsLogsRepository;
    private $YandexBucketsLogsRepository;
    private $YandexTasksLogsRepository;

    public function __construct()
    {
        $this->YandexConnectorsLogsRepository = new YandexConnectorsLogsRepository();
        $this->YandexBucketsLogsRepository    = new YandexBucketsLogsRepository();
        $this->YandexTasksLogsRepository      = new YandexTasksLogsRepository();
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
        $yandexTasksLogs      = $this->YandexTasksLogsRepository->getList($request);
        $yandexTasksLogsCount = $yandexTasksLogs->count();

        if ($yandexTasksLogs->count() > 0) {
            $yandexTasksLogsLastEvent = Carbon::parse(
                $yandexTasksLogs->last()->created_at
            )->diffForHumans(
                Carbon::now(),
                ['syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW]
            );
        } else {
            $yandexTasksLogsLastEvent = null;
        }

        $yandexBucketsLogs      = $this->YandexBucketsLogsRepository->getList($request);
        $yandexBucketsLogsCount = $yandexBucketsLogs->count();

        if ($yandexBucketsLogs->count() > 0) {
            $yandexBucketsLogsLastEvent = Carbon::parse(
                $yandexBucketsLogs->last()->created_at
            )->diffForHumans(
                Carbon::now(),
                ['syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW]
            );
        } else {
            $yandexBucketsLogsLastEvent = null;
        }

        $yandexConnectorsLogs      = $this->YandexConnectorsLogsRepository->getList($request);
        $yandexConnectorsLogsCount = $yandexConnectorsLogs->count();

        if ($yandexConnectorsLogs->count() > 0) {
            $yandexConnectorsLogsLastEvent = Carbon::parse(
                $yandexConnectorsLogs->last()->created_at
            )->diffForHumans(
                Carbon::now(),
                ['syntax' => CarbonInterface::DIFF_RELATIVE_TO_NOW]
            );
        } else {
            $yandexConnectorsLogsLastEvent = null;
        }

        $totalCount = $yandexConnectorsLogsCount + $yandexBucketsLogsCount + $yandexTasksLogsCount;

        View::share('yandexTasksLogsCount', $yandexTasksLogsCount);
        View::share('yandexTasksLogsLastEvent', $yandexTasksLogsLastEvent);

        View::share('yandexBucketsLogsCount', $yandexBucketsLogsCount);
        View::share('yandexBucketsLogsLastEvent', $yandexBucketsLogsLastEvent);

        View::share('yandexConnectorsLogsCount', $yandexConnectorsLogsCount);
        View::share('yandexConnectorsLogsLastEvent', $yandexConnectorsLogsLastEvent);
        View::share('totalCount', $totalCount);

        return $next($request);
    }
}

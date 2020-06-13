<?php

namespace App\Http\Controllers\Admin\Backups;

use App\Helpers\SystemLog;
use App\Models\BackupYandexBuckets;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Backups\Yandex\BucketsStoreUpdateRequest;
use App\Models\BackupYandexBucketsLogs;
use App\Repositories\Backups\YandexBucketsLogsRepository;
use App\Repositories\Backups\YandexBucketsRepository;
use App\Repositories\Backups\YandexConnectorRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class YandexBucketsController.
 */
class YandexBucketsController extends Controller
{
    private $yandexBucketsRepository;
    private $yandexConnectorsRepository;
    private $yandexBucketsLogsRepository;

    public function __construct()
    {
        $this->yandexBucketsRepository     = new YandexBucketsRepository();
        $this->yandexConnectorsRepository  = new YandexConnectorRepository();
        $this->yandexBucketsLogsRepository = new YandexBucketsLogsRepository();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        $buckets  = $this->yandexBucketsRepository->getList($request);
        $logs     = $this->yandexBucketsLogsRepository->getList($request);
        $logCount = $this->yandexBucketsLogsRepository->getCount($request);

        return view('admin.backups.yandex.buckets.index', compact('buckets', 'logs', 'logCount'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        $bucket     = $this->yandexBucketsRepository->getBucket($request);
        $connectors = $this->yandexConnectorsRepository->getPluckList($request);

        return view('admin.backups.yandex.buckets.edit', compact('bucket', 'connectors'));
    }

    /**
     * @param BucketsStoreUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(BucketsStoreUpdateRequest $request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        try {
            $this->yandexBucketsRepository->updateBucket($request);

            flash('Данные обновлены')->success();

            return redirect()->route('backups.yandex.buckets.index');
        } catch (\Exception $e) {
            //TODO писать ошибку в общий лог
        }
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        $connectors = $this->yandexConnectorsRepository->getPluckList($request);

        return view('admin.backups.yandex.buckets.create', compact('connectors'));
    }

    /**
     * @param BucketsStoreUpdateRequest $request
     * @return RedirectResponse
     */
    public function store(BucketsStoreUpdateRequest $request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        $this->yandexBucketsRepository->createBucket($request);

        return redirect()->route('backups.yandex.buckets.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        $this->yandexBucketsRepository->destroyBucket($request);

        flash('Задание удалено.')->success();

        return redirect()->route('backups.yandex.buckets.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function resolve(Request $request)
    {
        SystemLog::createUserEvent(__FUNCTION__, $request);

        BackupYandexBucketsLogs::where('resolved', 0)->update(['resolved' => 1]);

        return redirect()->route('backups.yandex.buckets.index');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(Request $request)
    {
        $bucket = BackupYandexBuckets::find($request->id);

        return view('admin.backups.yandex.buckets.show', compact('bucket'));

    }
}

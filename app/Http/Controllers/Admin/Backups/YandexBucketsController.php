<?php

namespace App\Http\Controllers\Admin\Backups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Backups\YandexBucketsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\Backups\YandexConnectorRepository;
use App\Repositories\Backups\YandexBucketsLogsRepository;
use App\Http\Requests\Admin\Backups\Yandex\BucketsStoreUpdateRequest;

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
        parent::__construct();
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
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

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
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $bucket     = $this->yandexBucketsRepository->getBucket($request);
        $connectors = $this->yandexConnectorsRepository->getPluckList();

        return view('admin.backups.yandex.buckets.edit', compact('bucket', 'connectors'));
    }

    /**
     * @param BucketsStoreUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(BucketsStoreUpdateRequest $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

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
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $connectors = $this->yandexConnectorsRepository->getPluckList();

        return view('admin.backups.yandex.buckets.create', compact('connectors'));
    }

    /**
     * @param BucketsStoreUpdateRequest $request
     * @return RedirectResponse
     */
    public function store(BucketsStoreUpdateRequest $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $this->yandexBucketsRepository->createBucket($request);

        return redirect()->route('backups.yandex.buckets.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $this->yandexBucketsRepository->destroyBucket($request);

        flash('Задание удалено.')->success();

        return redirect()->route('backups.yandex.buckets.index');
    }
}

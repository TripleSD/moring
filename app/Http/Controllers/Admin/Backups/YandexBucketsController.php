<?php

namespace App\Http\Controllers\Admin\Backups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\BackupYandexBucketsLogs;
use App\Repositories\Backups\YandexBucketsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\Backups\YandexConnectorRepository;
use App\Http\Requests\Admin\Backups\BucketsStoreRequest;

/**
 * Class YandexBucketsController.
 */
class YandexBucketsController extends Controller
{
    private $yandexBucketsRepository;
    private $yandexConnectorsRepository;

    public function __construct()
    {
        $this->yandexBucketsRepository   = new YandexBucketsRepository();
        $this->yandexConnectorsRepository = new YandexConnectorRepository();
    }

    /**
     * @param Request $request
     * @param YandexBucketsRepository $yandexBucketsRepository
     * @return Application|Factory|View
     */
    public function index(Request $request, YandexBucketsRepository $yandexBucketsRepository)
    {
        $buckets = $yandexBucketsRepository->getList($request);
        $logs    = BackupYandexBucketsLogs::where('status', 0)
            ->where('resolved', 0)
            ->orderBy('id')
            ->limit('50')
            ->get();

        return view('admin.backups.yandex.buckets.index', compact('buckets', 'logs'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $bucket     = $this->yandexBucketsRepository->getBucket($request);
        $connectors = $this->yandexConnectorsRepository->getPluckList();

        return view('admin.backups.yandex.buckets.edit', compact('bucket', 'connectors'));
    }

    /**
     * @param BucketsStoreRequest $request
     * @return RedirectResponse
     */
    public function update(BucketsStoreRequest $request)
    {
        try {
            $this->yandexBucketsRepository->updateBucket($request);

            flash('Данные обновлены')->success();

            return redirect()->route('backups.yandex.buckets.index');
        } catch (\Exception $e) {
            //TODO писать ошибку в общий лог
        }
    }

    public function create()
    {
        $connectors = $this->yandexConnectorsRepository->getPluckList();

        return view('admin.backups.yandex.buckets.create', compact('connectors'));
    }
}

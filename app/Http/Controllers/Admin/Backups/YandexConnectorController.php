<?php

namespace App\Http\Controllers\Admin\Backups;

use App;
use Lang;
use App\Models\BackupYandexTask;
use App\Models\BackupYandexBuckets;
use App\Http\Controllers\Controller;
use App\Models\BackupYandexConnectors;
use App\Models\BackupYandexConnectorsLogs;
use App\Repositories\System\SystemLogRepository;
use App\Repositories\Backups\YandexConnectorRepository;
use App\Repositories\Backups\YandexBucketsRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\Backups\YandexConnectorsLogsRepository;
use App\Http\Requests\Admin\Backups\Yandex\ConnectorsStoreUpdateRequest;

/**
 * Class YandexConnectorsController.
 */
class YandexConnectorController extends Controller
{
    private $yandexConnectorsRepository;
    private $yandexBucketsRepository;
    private $yandexConnectorsLogsRepository;
    private $systemLog;

    public function __construct()
    {
        $this->systemLog                      = new SystemLogRepository();
        $this->yandexConnectorsRepository     = new YandexConnectorRepository();
        $this->yandexBucketsRepository        = new YandexBucketsRepository();
        $this->yandexConnectorsLogsRepository = new yandexConnectorsLogsRepository();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $connectors = $this->yandexConnectorsRepository->getList();
        $logs       = $this->yandexConnectorsLogsRepository->getList();
        $logCount   = $this->yandexConnectorsLogsRepository->getCount();

        return view('admin.backups.yandex.connectors.index', compact('connectors', 'logs', 'logCount'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $connector = BackupYandexConnectors::find($request->id);

        return view('admin.backups.yandex.connectors.edit', compact('connector'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function create(Request $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        return view('admin.backups.yandex.connectors.create');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(Request $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $connector = BackupYandexConnectors::with('logs')->find($request->id);
        $tasks     = BackupYandexTask::where('connector_id', $request->id)->get();
        $buckets   = BackupYandexBuckets::where('connector_id', $request->id)->get();

        return view('admin.backups.yandex.connectors.show', compact('connector', 'tasks', 'buckets'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function clean(Request $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        if ($this->yandexBucketsRepository->cleanTrash($request)) {
            $this->yandexConnectorsRepository->refreshState($request);
            flash('Корзина очищена')->success();
        } else {
            flash('Очистка поставлена в очередь')->success();
        }

        return redirect()->route('backups.yandex.connectors.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function refresh(Request $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $result = $this->yandexConnectorsRepository->refreshState($request);

        if ($result) {
            flash('Данные обновлены')->success();
        } else {
            flash('Что-то пошло нет так')->warning();
        }

        return redirect()->route('backups.yandex.connectors.index');
    }

    /**
     * @param ConnectorsStoreUpdateRequest $request
     * @return RedirectResponse
     */
    public function store(ConnectorsStoreUpdateRequest $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $verifiedData = $request->validated();
        $connector    = $this->yandexConnectorsRepository->store($verifiedData);

        $this->yandexConnectorsRepository->refreshState($connector->id);

        flash('Коннектор добавлен')->success();

        return redirect()->route('backups.yandex.connectors.index');
    }

    /**
     * @param ConnectorsStoreUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(ConnectorsStoreUpdateRequest $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        $verifiedData = $request->validated();
        $connectorId  = $request->id;

        $this->yandexConnectorsRepository->update($connectorId, $verifiedData);
        $this->yandexConnectorsRepository->refreshState($connectorId);

        flash('Данные обновлены.')->success();

        return redirect()->route('backups.yandex.connectors.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        try {
            BackupYandexConnectors::where('id', $request->id)->delete();
            BackupYandexConnectorsLogs::where('connector_id', $request->id)->delete();
            flash('Коннектор удален.')->success();

            return redirect()->route('backups.yandex.connectors.index');
        } catch (\Exception $e) {
            flash(Lang::get('messages.system_logs.errors.error'))->warning();

            $this->systemLog->createServiceEvent(
                __FUNCTION__,
                'mysql',
                'messages.system_logs.errors.mysql.foreign_key',
                $e->getMessage()
            );

            return redirect()->route('backups.yandex.connectors.index');
        }
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function resolve(Request $request)
    {
        $this->systemLog->createUserEvent(__FUNCTION__, $request);

        BackupYandexConnectorsLogs::where('resolved', 0)->update(['resolved' => 1]);

        return redirect()->route('backups.yandex.connectors.index');
    }
}

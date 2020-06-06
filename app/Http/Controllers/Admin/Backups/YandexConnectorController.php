<?php

namespace App\Http\Controllers\Admin\Backups;

use App;
use Lang;
use App\Http\Controllers\Controller;
use App\Models\BackupYandexConnectors;
use App\Models\BackupYandexConnectorsLogs;
use App\Http\Controllers\Admin\System\LogController;
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
    private $logController;

    public function __construct()
    {
        $this->logController                  = new LogController();
        $this->yandexConnectorsRepository     = new YandexConnectorRepository();
        $this->yandexBucketsRepository        = new YandexBucketsRepository();
        $this->yandexConnectorsLogsRepository = new yandexConnectorsLogsRepository();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
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
        $connector = BackupYandexConnectors::find($request->id);

        return view('admin.backups.yandex.connectors.edit', compact('connector'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.backups.yandex.connectors.create');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(Request $request)
    {
        $connector = BackupYandexConnectors::with('logs')->find($request->id);

        return view('admin.backups.yandex.connectors.show', compact('connector'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function clean(Request $request)
    {
        $this->logController->insert(
            \Config::get('moring.service.yandex.disk'),
            '-',
            '',
            \Auth::user()->id,
            \Route::getCurrentRoute()->getActionName()
        );

            if ($this->yandexBucketsRepository->cleanTrash($request)) {
                $this->yandexConnectorsRepository->refreshState($request->id);
                flash('Корзина очищена')->success();
            } else {
                flash('Очистка поставлена в очередь')->success();
            }

            return redirect()->route('backups.yandex.connectors.index');
    }

    public function refresh(Request $request)
    {
        $this->logController->insert(
            \Config::get('moring.service_yandex_disk'),
            '-',
            $request->method(),
            \Auth::user()->id,
            \Route::getCurrentRoute()->getActionName()
        );

        $result = $this->yandexConnectorsRepository->refreshState($request->id);

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
        try {
            BackupYandexConnectors::where('id', $request->id)->delete();
            BackupYandexConnectorsLogs::where('connector_id', $request->id)->delete();
            flash('Коннектор удален.')->success();

            return redirect()->route('backups.yandex.connectors.index');
        } catch (\Exception $e) {
            flash(Lang::get('messages.system_logs.errors.error'))->warning();

            $this->logController->insert(
                \Config::get('moring.service_mysql'),
                'messages.system_logs.errors.error.foreign_key',
                $e->getMessage(),
                \Auth::user()->id,
                \Route::getCurrentRoute()->getActionName()
            );

            return redirect()->route('backups.yandex.connectors.index');
        }
    }

    /**
     * @return RedirectResponse
     */
    public function resolve()
    {
        BackupYandexConnectorsLogs::where('resolved', 0)->update(['resolved' => 1]);

        return redirect()->route('backups.yandex.connectors.index');
    }
}

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
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Repositories\Backups\YandexConnectorsLogsRepository;

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

        return view('admin.backups.yandex.connectors.index', compact('connectors', 'logs'));
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
        try {
            if ($this->yandexBucketsRepository->cleanTrash($request)) {
                $this->yandexConnectorsRepository->refresh($request->id);
                flash('Корзина очищена')->success();
                return redirect()->route('backups.yandex.connectors.index');
            } else {
                flash('Очистка поставлена в очередь')->success();
                return redirect()->route('backups.yandex.connectors.index');
            }
        } catch (\Exception $e) {
            flash('Что-то пошло нет так')->warning();
            $this->logController->insert(
                \Config::get('moring.service.yandex.disk'),
                '-',
                $e->getMessage(),
                \Auth::user()->id,
                \Route::getCurrentRoute()->getActionName()
            );
            return redirect()->route('backups.yandex.connectors.index');
        }
    }

    public function refresh(Request $request)
    {
        $result = $this->yandexConnectorsRepository->refresh($request->id);

        if ($result) {
            flash('Данные обновлены')->success();
        } else {
            flash('Что-то пошло нет так')->warning();
        }

        return redirect()->route('backups.yandex.connectors.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $fill = $this->validate(
            $request,
            [
                'description' => 'required',
                'token' => 'required',
                'comment' => 'nullable',
            ],
            [

            ]
        );

        $fill['status']      = 1;
        $fill['total_space'] = 0;
        $fill['used_space']  = 0;
        $fill['trash_size']  = 0;
        $fill['http_code']   = 200;

        $connector = BackupYandexConnectors::create($fill);
        $this->yandexConnectorsRepository->refresh($connector->id);
        flash('Коннектор добавлен')->success();

        return redirect()->route('backups.yandex.connectors.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $fill = $this->validate(
            $request,
            [
                'description' => 'required',
                'token' => 'required',
                'comment' => 'nullable',
            ],
            [

            ]
        );

        $fill['status']      = 1;
        $fill['total_space'] = 0;
        $fill['used_space']  = 0;
        $fill['trash_size']  = 0;
        $fill['http_code']   = 200;

        BackupYandexConnectors::where('id', $request->id)->update($fill);
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
}

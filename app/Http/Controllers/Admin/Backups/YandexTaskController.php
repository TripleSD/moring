<?php

namespace App\Http\Controllers\Admin\Backups;

use App\Http\Controllers\Controller;
use App\Models\BackupYandexTask;
use App\Models\BackupYandexTasksLogs;
use App\Repositories\Backups\YandexConnectorRepository;
use App\Repositories\Backups\YandexTaskRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Repositories\Backups\YandexTasksLogsRepository;

/**
 * Class BackupYandexController.
 */
class YandexTaskController extends Controller
{
    private $YandexTasksRepository;
    private $YandexConnectorsRepository;
    private $YandexTasksLogsRepository;

    public function __construct()
    {
        parent::__construct();
        $this->YandexTasksRepository           = new YandexTaskRepository();
        $this->YandexTasksLogsRepository = new YandexTasksLogsRepository();
        $this->YandexConnectorsRepository      = new YandexConnectorRepository();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $tasks    = $this->YandexTasksRepository->getList();
        $logs     = $this->YandexTasksLogsRepository->getList();
        $logCount = $this->YandexTasksLogsRepository->getCount();

        return view('admin.backups.yandex.tasks.index', compact('tasks', 'logs', 'logCount'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $task       = $this->YandexTasksRepository->getTask($request);
        $connectors = $this->YandexConnectorsRepository->getPluckList();

        return view('admin.backups.yandex.tasks.edit', compact('task', 'connectors'));
    }

    public function update(Request $request)
    {
        $fill = $this->validate(
            $request,
            [
                'description' => 'required',
                'connector_id' => 'required',
                'folder' => 'nullable',
                'pre' => 'nullable',
                'post' => 'nullable',
                'filename' => 'required',
                'interval' => 'required',
                'comment' => 'nullable',
            ],
            [

            ]
        );

        BackupYandexTask::where('id', $request->id)->update($fill);

        flash('Данные обновлены.')->success();

        return redirect()->route('backups.yandex.tasks.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $connectors = $this->YandexConnectorsRepository->getPluckList();

        return view('admin.backups.yandex.tasks.create', compact('connectors'));
    }

    public function store(Request $request)
    {
        $fill              = $this->validate(
            $request,
            [
                'description' => 'required',
                'connector_id' => 'required',
                'folder' => 'nullable',
                'pre' => 'nullable',
                'post' => 'nullable',
                'filename' => 'required',
                'interval' => 'required',
                'comment' => 'nullable',
            ],
            [

            ]
        );
        $fill['enabled']   = 1;
        $fill['http_code'] = 200;

        BackupYandexTask::create($fill);

        flash('Задание добавлено.')->success();

        return redirect()->route('backups.yandex.tasks.index');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(Request $request)
    {
        $task = $this->YandexTasksRepository->getTask($request);

        return view('admin.backups.yandex.tasks.show', compact('task'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        BackupYandexTask::where('id', $request->id)->delete();

        flash('Задание удалено.')->success();

        return redirect()->route('backups.yandex.tasks.index');
    }
}

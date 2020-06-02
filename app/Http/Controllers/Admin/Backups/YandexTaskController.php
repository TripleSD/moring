<?php

namespace App\Http\Controllers\Admin\Backups;

use Illuminate\Http\Request;
use App\Models\BackupYandexTask;
use App\Http\Controllers\Controller;
use App\Models\BackupYandexConnectors;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\Backups\YandexTaskRepository;
use App\Repositories\Backups\YandexConnectorRepository;

/**
 * Class BackupYandexController
 * @package App\Http\Controllers\Admin\Backups
 */
class YandexTaskController extends Controller
{
    private $yandexRepository;
    private $yandexConnectorsRepository;

    public function __construct()
    {
        $this->yandexRepository           = new YandexTaskRepository();
        $this->yandexConnectorsRepository = new YandexConnectorRepository();
    }

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        $tasks = $this->yandexRepository->getList();

        return view('admin.backups.yandex.tasks.index', compact('tasks'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $task       = $this->yandexRepository->getTask($request);
        $connectors = $this->yandexConnectorsRepository->getPluckList();

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
        $connectors = $this->yandexConnectorsRepository->getPluckList();

        return view('admin.backups.yandex.tasks.create', compact('connectors'));
    }
}

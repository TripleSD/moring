<?php

namespace App\Http\Controllers\Admin\Backups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $this->yandexRepository = new YandexTaskRepository();
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
        $task = $this->yandexRepository->getTask($request);
        $connectors = $this->yandexConnectorsRepository->getPluckList();

        return view('admin.backups.yandex.tasks.edit', compact('task', 'connectors'));
    }
}

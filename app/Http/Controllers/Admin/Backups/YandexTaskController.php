<?php

namespace App\Http\Controllers\Admin\Backups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\Backups\YandexTaskRepository;

/**
 * Class BackupYandexController
 * @package App\Http\Controllers\Admin\Backups
 */
class YandexTaskController extends Controller
{
    private $yandexRepository;

    public function __construct()
    {
        $this->yandexRepository = new YandexTaskRepository();
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

        return view('admin.backups.yandex.tasks.edit', compact('task'));
    }
}

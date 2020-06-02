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
     * @param yandexTaskRepository $yandexRepository
     * @return Application|Factory|View
     */
    public function index(YandexTaskRepository $yandexRepository)
    {
        $tasks = $yandexRepository->getList();

        return view('admin.backups.yandex.tasks.index', compact('tasks'));
    }

    public function edit(Request $request)
    {
        $task = YandexTaskRepository::where('id', $request->id)->get();

        return view('admin.backups.yandex.tasks.edit', compact('task'));
    }
}

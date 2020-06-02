<?php

namespace App\Http\Controllers\Admin\Backups;

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
        $tasks = $yandexRepository->tasksList();

        return view('admin.backups.yandex.tasks.index', compact('tasks'));
    }
}

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
    private $BackupYandexRepository;

    public function __construct()
    {
        $this->BackupYandexRepository = new YandexTaskRepository();
    }

    /**
     * @param YandexTaskRepository $BackupYandexRepository
     * @return Application|Factory|View
     */
    public function index(YandexTaskRepository $BackupYandexRepository)
    {
        $tasks = $BackupYandexRepository->tasksList();

        return view('admin.backups.yandex.tasks.index', compact('tasks'));
    }
}

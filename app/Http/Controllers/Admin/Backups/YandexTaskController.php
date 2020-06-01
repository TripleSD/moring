<?php

namespace App\Http\Controllers\Admin\Backups;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\Backups\BackupYandexRepository;

/**
 * Class BackupYandexController
 * @package App\Http\Controllers\Admin\Backups
 */
class YandexTaskController extends Controller
{
    private $BackupYandexRepository;

    public function __construct()
    {
        $this->BackupYandexRepository = new BackupYandexRepository();
    }

    /**
     * @param BackupYandexRepository $BackupYandexRepository
     * @return Application|Factory|View
     */
    public function index(BackupYandexRepository $BackupYandexRepository)
    {
        $tasks = $BackupYandexRepository->tasksList();

        return view('admin.backups.yandex.tasks.index', compact('tasks'));
    }
}

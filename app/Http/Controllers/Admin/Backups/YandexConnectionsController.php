<?php

namespace App\Http\Controllers\Admin\Backups;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\Backups\BackupYandexConnectionsRepository;

/**
 * Class BackupYandexController
 * @package App\Http\Controllers\Admin\Backups
 */
class YandexConnectionsController extends Controller
{
    private $BackupYandexConnectionsRepository;

    public function __construct()
    {
        $this->BackupYandexConnectionsRepository = new BackupYandexConnectionsRepository();
    }

    /**
     * @param BackupYandexConnectionsRepository $BackupYandexConnectionsRepository
     * @return Application|Factory|View
     */
    public function index(BackupYandexConnectionsRepository $BackupYandexConnectionsRepository)
    {
        $connections = $BackupYandexConnectionsRepository->connectionsList();

        return view('admin.backups.yandex.connections.index', compact('connections'));
    }
}

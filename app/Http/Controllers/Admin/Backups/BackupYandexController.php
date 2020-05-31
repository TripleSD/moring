<?php

namespace App\Http\Controllers\Admin\Backups;

use App\Http\Controllers\Controller;
use App\Models\BackupFtpList;
use App\Repositories\Backups\BackupFtpRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

/**
 * Class BackupYandexController
 * @package App\Http\Controllers\Admin\Backups
 */
class BackupYandexController extends Controller
{
    /**
     * @param BackupFtpRepository $backupFtpRepository
     * @return Application|Factory|View
     */
    public function index(BackupFtpRepository $backupFtpRepository)
    {
        $tasks = $backupFtpRepository->tasksList();

        return view('admin.backups.yandex.index', compact('tasks'));
    }
}

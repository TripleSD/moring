<?php

namespace App\Http\Controllers\Admin\Backups;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\BackupFtpList;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;
use App\Repositories\Backups\BackupFtpRepository;

/**
 * Class BackupFtpController
 * @package App\Http\Controllers\Admin\Backups
 */
class BackupFtpController extends Controller
{
    private $BackupFtpRepository;

    public function __construct()
    {
        $this->BackupFtpRepository = new BackupFtpRepository();
    }

    /**
     * @param BackupFtpRepository $backupFtpRepository
     * @return Application|Factory|View
     */
    public function index(BackupFtpRepository $backupFtpRepository)
    {
        $tasks = $backupFtpRepository->tasksList();

        return view('admin.backups.ftp.index', compact('tasks'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.backups.ftp.create');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $task = BackupFtpList::find($request->ftp);

        return view('admin.backups.ftp.edit', compact('task'));
    }
}

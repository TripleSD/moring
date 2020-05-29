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
 * Class BackupFtpController
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

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $fill = $this->validate(
            $request,
            [
                'description' => 'required',
                'hostname' => 'required',
                'port' => 'integer',
                'folder' => 'alpha_dash',
                'pre' => 'nullable',
                'post' => 'nullable',
                'filename' => 'required',
                'interval' => 'integer',
            ],
            [

            ]
        );

        BackupFtpList::create($fill);

        flash('Данные сохранены')->success();

        return redirect()->route('backups.ftp.index');
    }

    public function show(Request $request)
    {
        $task = BackupFtpList::with('logs')->find($request->ftp);

        return view('admin.backups.ftp.show', compact('task'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        $fill = $this->validate(
            $request,
            [
                'description' => 'required',
                'hostname' => 'required',
                'port' => 'integer',
                'folder' => 'alpha_dash',
                'pre' => 'nullable',
                'post' => 'nullable',
                'filename' => 'required',
                'interval' => 'integer',
            ],
            [

            ]
        );

        BackupFtpList::where('id', $request->ftp)->update($fill);

        flash('Данные обновлны')->success();

        return redirect()->route('backups.ftp.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        BackupFtpList::where('id', $request->ftp)->delete();

        flash('Запись удалена')->success();

        return redirect()->route('backups.ftp.index');
    }
}

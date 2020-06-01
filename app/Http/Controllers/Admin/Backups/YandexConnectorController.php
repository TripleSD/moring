<?php

namespace App\Http\Controllers\Admin\Backups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Models\BackupYandexConnectors;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\Backups\YandexTrashRepository;
use App\Repositories\Backups\YandexConnectorRepository;

/**
 * Class YandexConnectorsController
 * @package App\Http\Controllers\Admin\Backups
 */
class YandexConnectorController extends Controller
{
    private $yandexConnectorsRepository;
    private $yandexTrashRepository;

    public function __construct()
    {
        $this->yandexConnectorsRepository = new YandexConnectorRepository();
        $this->yandexTrashRepository      = new YandexTrashRepository();
    }

    /**
     * @param YandexConnectorRepository $yandexConnectorsRepository
     * @return Application|Factory|View
     */
    public function index(YandexConnectorRepository $yandexConnectorsRepository)
    {
        $connectors = $yandexConnectorsRepository->getList();

        return view('admin.backups.yandex.connectors.index', compact('connectors'));
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $connector = BackupYandexConnectors::find($request->id);

        return view('admin.backups.yandex.connectors.edit', compact('connector'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.backups.yandex.connectors.create');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function show(Request $request)
    {
        $connector = BackupYandexConnectors::find($request->id);

        return view('admin.backups.yandex.connectors.show', compact('connector'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function clean(Request $request)
    {
        $result = $this->yandexTrashRepository->cleanTrash($request);

        if ($result) {
            flash('Корзина успешно очищена')->success();
        } else {
            flash('Что-то пошло нет так')->warning();
        }

        return redirect()->route('backups.yandex.connectors.index');
    }
}
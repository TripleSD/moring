<?php

namespace App\Http\Controllers\Admin\Backups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BackupYandexConnectors;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\Backups\YandexConnectorsRepository;

/**
 * Class YandexConnectorsController
 * @package App\Http\Controllers\Admin\Backups
 */
class YandexConnectorController extends Controller
{
    private $YandexConnectorsRepository;

    public function __construct()
    {
        $this->YandexConnectorsRepository = new YandexConnectorsRepository();
    }

    /**
     * @param YandexConnectorsRepository $YandexConnectorsRepository
     * @return Application|Factory|View
     */
    public function index(YandexConnectorsRepository $YandexConnectorsRepository)
    {
        $connectors = $YandexConnectorsRepository->getList();

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
}

<?php

namespace App\Http\Controllers\Admin\Backups;

use App\Http\Controllers\Controller;
use App\Repositories\Backups\YandexTrashRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class YandexTrashController
 */
class YandexTrashController extends Controller
{
    private $yandexTrashRepository;

    public function __construct()
    {
        $this->yandexTrashRepository = new YandexTrashRepository();
    }

    /**
     * @param YandexTrashRepository $yandexTrashRepository
     * @return Application|Factory|View
     */
    public function index(YandexTrashRepository $yandexTrashRepository)
    {
        $trash = $yandexTrashRepository->getList();

        return view('admin.backups.yandex.trash.index', compact('trash'));
    }
}

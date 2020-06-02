<?php

namespace App\Http\Controllers\Admin\Backups;

use App\Http\Controllers\Controller;
use App\Repositories\Backups\YandexBasketRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class YandexBasketsController.
 */
class YandexBasketController extends Controller
{
    private $yandexBasketRepository;

    public function __construct()
    {
        $this->yandexBasketRepository = new YandexBasketRepository();
    }

    /**
     * @param YandexBasketRepository $yandexBasketRepository
     * @return Application|Factory|View
     */
    public function index(YandexBasketRepository $yandexBasketRepository)
    {
        $baskets = $yandexBasketRepository->getList();

        return view('admin.backups.yandex.baskets.index', compact('baskets'));
    }
}

<?php

namespace App\Http\Controllers\Admin\Backups;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Repositories\Backups\YandexBasketRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Repositories\Backups\YandexConnectorRepository;
use App\Http\Requests\Admin\Backups\BasketsStoreRequest;

/**
 * Class YandexBasketsController.
 */
class YandexBasketController extends Controller
{
    private $yandexBasketRepository;
    private $yandexConnectorRepository;

    public function __construct()
    {
        $this->yandexBasketRepository    = new YandexBasketRepository();
        $this->yandexConnectorRepository = new YandexConnectorRepository();
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

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function edit(Request $request)
    {
        $basket     = $this->yandexBasketRepository->getBasket($request);
        $connectors = $this->yandexConnectorRepository->getPluckList();

        return view('admin.backups.yandex.baskets.edit', compact('basket', 'connectors'));
    }

    /**
     * @param BasketsStoreRequest $request
     * @return RedirectResponse
     */
    public function update(BasketsStoreRequest $request)
    {
        try {
            $this->yandexBasketRepository->updateBasket($request->validated(), $request->id);

            flash('Данные обновлены')->success();

            return redirect()->route('backups.yandex.baskets.index');
        } catch (\Exception $e) {
            //TODO писать ошибку в общий лог
        }
    }
}

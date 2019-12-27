<?php

namespace App\Http\Controllers\Admin\Network;

use Exception;
use App\Http\Controllers\Controller;
use App\Repositories\Devices\DevicesVendorsRepository;
use App\Http\Requests\Sites\UpdateAndStoreDeviceRequest;
use App\Repositories\Devices\DevicesRepository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NetworkDevicesController extends Controller
{
    /** @var DevicesRepository */
    private $deviceRepository;
    private $deviceVendorsRepository;

    /**
     * NetworkDevicesController constructor.
     */
    public function __construct()
    {
        $this->deviceRepository        = new DevicesRepository();
        $this->deviceVendorsRepository = new DevicesVendorsRepository();
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $devices = $this->deviceRepository->getDevicesList($request);

        return view('admin.network.devices.index', compact('devices'));
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        return view('admin.network.devices.create');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function edit(Request $request)
    {
        $device = $this->deviceRepository->editDevice($request->device);

        return view('admin.network.devices.edit', compact('device'));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $this->deviceRepository->destroyDevice($request->device);

        return redirect()->route('network.devices.index');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function show(Request $request)
    {
        $device = $this->deviceRepository->show($request->device);

        return view('admin.network.devices.show', compact('device'));
    }


    /**
     * @param UpdateAndStoreDeviceRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateAndStoreDeviceRequest $request)
    {
        $this->deviceRepository->updateDevice($request);
        flash('Данные успешно обнолены')->success();

        return redirect()->route('network.devices.show', $request->device);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $deviceData = $this->deviceRepository->getDeviceData($request);
            $this->deviceRepository->storeDevice($deviceData);
            flash('Новое устройство добавлено.')->success();

            return redirect()->route('network.devices.index');
        } catch (Exception $exception) {
            flash($exception->getMessage())->warning();

            return redirect()->back()->withInput();
        }
    }
}

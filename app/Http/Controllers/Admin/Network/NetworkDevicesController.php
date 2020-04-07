<?php

namespace App\Http\Controllers\Admin\Network;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sites\UpdateAndStoreDeviceRequest;
use App\Models\Devices;
use App\Repositories\Devices\DevicesLogsRepository;
use App\Repositories\Devices\DevicesRepository;
use App\Repositories\Devices\DevicesVendorsRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NetworkDevicesController extends Controller
{
    private $deviceRepository;
    private $deviceVendorsRepository;
    private $deviceLogsRepository;

    /**
     * NetworkDevicesController constructor.
     */
    public function __construct()
    {
        $this->deviceRepository        = new DevicesRepository();
        $this->deviceVendorsRepository = new DevicesVendorsRepository();
        $this->deviceLogsRepository    = new DevicesLogsRepository();
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
        $device = $this->deviceRepository->edit($request->device);

        return view('admin.network.devices.edit', compact('device'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $this->deviceRepository->destroy($request->device);
        flash('Устройство успешно удалено.')->warning();

        return redirect()->route('network.devices.index');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function show(Request $request)
    {
        $logs   = $this->deviceLogsRepository->getLogsByDeviceId($request->device);
        $device = $this->deviceRepository->show($request->device);

        return view('admin.network.devices.show', compact('device', 'logs'));
    }

    /**
     * @param UpdateAndStoreDeviceRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateAndStoreDeviceRequest $request)
    {
        try {
            //TODO убрать дублирование кода
            $deviceData = $this->deviceRepository->getDeviceData($request);

            $deviceData['title']       = $request->input('title');
            $deviceData['enabled']     = $request->input('enabled')->default(0);
            $deviceData['port_ssh']    = $request->input('port_ssh');
            $deviceData['port_telnet'] = $request->input('port_telnet');
            $deviceData['web_url']     = $request->input('web_url');

            $this->deviceRepository->update($deviceData, $request->device);

            flash('Данные устройства успешно обновлены.')->success();

            return redirect()->route('network.devices.show', $request->device);
        } catch (Exception $exception) {
            flash($exception->getMessage())->warning();

            return redirect()->back()->withInput();
        }
    }

    public function store(UpdateAndStoreDeviceRequest $request): RedirectResponse
    {
        try {
            $device = Devices::where('hostname', $request->hostname)
                ->where('version', $request->version)
                ->where('port', $request->port)
                ->where('community', $request->community)
                ->get();

            if ($device->isNotEmpty()) {
                throw new Exception('Данное устройство уже есть в списке');
            }

            $deviceData                = $this->deviceRepository->getDeviceData($request);
            $deviceData['title']       = $request->input('title');
            $deviceData['enabled']     = 1;
            $deviceData['port_ssh']    = $request->input('port_ssh');
            $deviceData['port_telnet'] = $request->input('port_telnet');
            $deviceData['web_url']     = $request->input('web_url');

            $this->deviceRepository->store($deviceData);
            flash('Новое устройство успешно добавлено.')->success();

            return redirect()->route('network.devices.index');
        } catch (Exception $exception) {
            flash($exception->getMessage())->warning();

            return redirect()->back()->withInput();
        }
    }
}

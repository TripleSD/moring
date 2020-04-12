<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Network\NetworkDevicesController;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Connectors\TelegramConnector;
use App\Models\Devices;
use App\Repositories\Devices\DevicesRepository;
use Illuminate\Console\Command;

class SnmpDevicesChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SnmpDevicesChecker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $networkDevicesController;
    private $devicesRepository;
    private $telegramConnector;
    private $settingsController;

    /**
     * SnmpDevicesChecker constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->networkDevicesController = new NetworkDevicesController();
        $this->telegramConnector        = new TelegramConnector();
        $this->devicesRepository        = new DevicesRepository();
        $this->settingsController       = new SettingsController();
    }

    /**
     * @param int|null $device_id
     */
    public function handle(int $device_id = null)
    {
        $devices[] = Devices::find($device_id);

        if ($device_id === null) {
            $devices = Devices::get();
        }

        foreach ($devices as $device) {
            try {
                $deviceConnection['hostname']    = $device->hostname;
                $deviceConnection['community']   = $device->community;
                $deviceConnection['port']        = $device->port;
                $deviceConnection['version']     = $device->version;
                $deviceConnection['title']       = $device->title;
                $deviceConnection['enabled']     = $device->enabled;
                $deviceConnection['port_ssh']    = $device->port_ssh;
                $deviceConnection['port_telnet'] = $device->port_telnet;
                $deviceConnection['web_url']     = $device->web_url;

                $deviceData = $this->devicesRepository->getDeviceData($deviceConnection);
                $this->devicesRepository->update($deviceData, $device->id);
            } catch (\Exception $exception) {
                if ($this->settingsController->getTelegramStatus() === 1) {
                    try {
                        $chatId = $this->settingsController->getGroupChatId();
                        $this->telegramConnector->sendMessage(
                            $chatId,
                            trim(
                                "❌<b>Ошибка SNMP</b> \n" . $exception->getMessage() . "\n" .
                                "ID $device->id\n" . $device->vendor->title . ' ' . $device->model->title
                            )
                        );
                    } catch (\Exception $e) {
                    }
                }
            }
        }
    }
}

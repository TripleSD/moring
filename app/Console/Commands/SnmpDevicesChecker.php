<?php

namespace App\Console\Commands;

use App\Models\Devices;
use App\Repositories\Devices\DevicesRepository;
use App\Http\Controllers\Connectors\TelegramConnector;
use Illuminate\Console\Command;
use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Admin\Network\NetworkDevicesController;

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
        if (is_null($device_id)) {
            $devices = Devices::get();
        } else {
            $devices[] = Devices::find($device_id);
        }

        foreach ($devices as $device) {
            try {
                $deviceConnection['hostname']      = $device->hostname;
                $deviceConnection['title']         = $device->title;
                $deviceConnection['snmpCommunity'] = $device->snmp_community;
                $deviceConnection['snmpPort']      = $device->snmp_port;
                $deviceConnection['snmpVersion']   = $device->snmp_version;
                $deviceData                        = $this->devicesRepository->getDeviceData($deviceConnection);
                $this->devicesRepository->updateDevice($deviceData, $device->id);
            } catch (\Exception $exception) {
                if ($this->settingsController->getTelegramStatus() === 1) {
                    try {
                        $chatId = $this->settingsController->getGroupChatId();
                        $this->telegramConnector->sendMessage(
                            $chatId,
                            trim(
                                "❌<b>Ошибка SNMP</b> \n" . $exception->getMessage() . "\n" .
                                "ID $device->id\n" . $device->vendor->title . " " . $device->model->title
                            )
                        );
                    } catch (\Exception $e) {
                    }
                }
            }
        }
    }
}

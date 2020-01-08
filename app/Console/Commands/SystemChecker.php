<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Connectors\TelegramConnector;
use Illuminate\Console\Command;

class SystemChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SystemChecker';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public $settingsController;
    public $telegramConnector;

    public function __construct()
    {
        parent::__construct();
        $this->settingsController = new SettingsController();
        $this->telegramConnector  = new TelegramConnector();
    }

    public function handle()
    {
        if ($this->settingsController->getTelegramStatus() === 1) {
            try {
                $chatId = $this->settingsController->getGroupChatId();
                $this->telegramConnector->sendMessage(
                    $chatId,
                    trim(
                        "ℹ️<b>Информация</b> \n Система находится в рабочем состоянии"
                    )
                );
            } catch (\Exception $e) {
            }
        }
    }
}

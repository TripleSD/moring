<?php

use Illuminate\Database\Seeder;

class UpdateDefaultSettingsSeed extends Seeder
{

    public $settingsController;


    public function __construct(\App\Http\Controllers\Admin\Settings\SettingsController $settingsController)
    {
        $this->settingsController = $settingsController;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->settingsController->createApiKeyParam();
        $this->settingsController->createGroupChatIdParam();
        $this->settingsController->createIdentificatorParam();
        $this->settingsController->createTelegramStatusParam();
    }
}

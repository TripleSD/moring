<?php

namespace App\Http\Controllers\Admin\Settings\Integrations;

use App\Http\Controllers\Admin\Settings\SettingsController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\Integrations\IntegrationTelegramRequest;

class TelegramIntegrationsController extends Controller
{
    public $settingsController;

    public function __construct(SettingsController $settingsController)
    {
        $this->middleware('auth');
        $this->settingsController = $settingsController;
    }

    public function index()
    {
        $status = $this->settingsController->getTelegramStatus();
        $apiToken = $this->settingsController->getApiKey();
        $chatId = $this->settingsController->getGroupChatId();

        return view('admin.settings.integrations.index', compact('apiToken', 'chatId', 'status'));
    }

    public function update(IntegrationTelegramRequest $request)
    {
        $request->validated();
        $this->settingsController->updateTelegramStatus($request);
        $this->settingsController->updateApiKey($request);
        $this->settingsController->updateGroupChatId($request);
        flash('Данные обновлены')->success();

        return redirect()->route('settings.integrations.telegram.index');
    }
}

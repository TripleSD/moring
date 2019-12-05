<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Repositories\SettingsRepository;

class SettingsController extends Controller
{
    public $settingsRepository;

    public function __construct()
    {
        $this->middleware('auth');
        $this->settingsRepository = new SettingsRepository();
    }

    public function getTelegramStatus()
    {
        return (int)$this->settingsRepository->getTelegramStatus();
    }

    public function getApiKey()
    {
        return (string)$this->settingsRepository->getApiKey();
    }

    public function getGroupChatId()
    {
        return (string)$this->settingsRepository->getGroupChatId();
    }

    public function updateTelegramStatus($request)
    {
        return $this->settingsRepository->updateTelegramStatus($request);
    }

    public function updateApiKey($request)
    {
        return $this->settingsRepository->updateApiKey($request);
    }

    public function updateGroupChatId($request)
    {
        return $this->settingsRepository->updateGroupChatId($request);
    }

    public function getIdentificator()
    {
        return (string)$this->settingsRepository->getIdentificator();
    }

    public function updateIdentificatorParam($identficator)
    {
        $this->settingsRepository->updateIdentificatorParam($identficator);
    }
}

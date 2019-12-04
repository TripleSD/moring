<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Repositories\SettingsRepository;

class SettingsController extends Controller
{
    public $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->middleware('auth');
        $this->settingsRepository = $settingsRepository;
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
}

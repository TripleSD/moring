<?php

namespace App\Repositories;

use App\Models\Settings;

class SettingsRepository extends Repository
{
    public function getTelegramStatus()
    {
        $status = Settings::where('parameter', 'telegram_enable_status')->firstOrFail();
        return (int)$status->value;
    }

    public function getApiKey()
    {
        $apiKey = Settings::where('parameter', 'telegram_api_key')->first();
        return (string)$apiKey->value;
    }

    public function getGroupChatId()
    {
        $chatId = Settings::where('parameter', 'telegram_group_chat_id')->first();
        return (string)$chatId->value;
    }

    public function updateTelegramStatus($request)
    {
        return Settings::where('parameter', 'telegram_enable_status')
            ->update(['value' => $request->input('telegram_enable_status')]);
    }

    public function updateApiKey($request)
    {
        return Settings::where('parameter', 'telegram_api_key')
            ->update(['value' => $request->input('telegram_api_key')]);
    }

    public function updateGroupChatId($request)
    {
        return Settings::where('parameter', 'telegram_group_chat_id')
            ->update(['value' => $request->input('telegram_group_chat_id')]);
    }

    public function createApiKeyParam()
    {
        $param = Settings::where('parameter', 'telegram_api_key')->first();
        if ($param == null) {
            $settings = new Settings();
            $settings->parameter = 'telegram_api_key';
            $settings->value = '';
            $settings->save();
        }
    }

    public function createGroupChatIdParam()
    {
        $param = Settings::where('parameter', 'telegram_group_chat_id')->first();
        if ($param == null) {
            $settings = new Settings();
            $settings->parameter = 'telegram_group_chat_id';
            $settings->value = '';
            $settings->save();
        }
    }

    public function createTelegramStatusParam()
    {
        $param = Settings::where('parameter', 'telegram_enable_status')->first();
        if ($param == null) {
            $settings = new Settings();
            $settings->parameter = 'telegram_enable_status';
            $settings->value = 0;
            $settings->save();
        }
    }

    public function createIdentificatorParam()
    {
        $param = Settings::where('parameter', 'identificator')->first();
        if ($param == null) {
            $settings = new Settings();
            $settings->parameter = 'identificator';
            $settings->value = '';
            $settings->save();
        }
    }
}

<?php

namespace App\Repositories;

use App\Models\Settings;

class SettingsRepository extends Repository
{
    public function getTelegramStatus()
    {
        return (int)Settings::where('parameter', 'telegram_enable_status')->value('value');
    }

    public function getApiKey()
    {
        return (string)Settings::where('parameter', 'telegram_api_key')->value('value');
    }

    public function getGroupChatId()
    {
        return (string)Settings::where('parameter', 'telegram_group_chat_id')->value('value');
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

    public function getIdentificator()
    {
        return (string)Settings::where('parameter', 'identificator')->value('value');
    }

    public function updateIdentificatorParam($identificator)
    {
        return Settings::where('parameter', 'identificator')
            ->update(['value' => $identificator]);
    }
}

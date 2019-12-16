<?php

namespace App\Repositories;

use App\Models\Settings;

class SettingsRepository extends Repository
{
    public function getTelegramStatus()
    {
        $status = Settings::where('parameter', 'telegram_enable_status')->firstOrFail();

        return (int) $status->value;
    }

    public function getApiKey()
    {
        $apiKey = Settings::where('parameter', 'telegram_api_key')->first();

        return (string) $apiKey->value;
    }

    public function getGroupChatId()
    {
        $chatId = Settings::where('parameter', 'telegram_group_chat_id')->first();

        return (string) $chatId->value;
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
        $identificator = Settings::where('parameter', 'identificator')->first();

        if ($identificator->value == null) {
            return (string) null;
        }

        return (string) $identificator->value;
    }

    public function updateIdentificatorParam($identificator)
    {
        return Settings::where('parameter', 'identificator')
            ->update(['value' => $identificator]);
    }
}

<?php

namespace App\Http\Controllers\Connectors;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use GuzzleHttp\Client;

class TelegramConnector extends Controller
{
    public function sendMessage($chatId, $messageText)
    {
        $settings = Settings::where('parameter', 'telegram_api_key')->firstOrFail();
        $apiKey = $settings->value;
        $client = new Client();
        try {
            $param = [
                'timeout' => 5,
                'query' => ['chat_id' => $chatId, 'text' => $messageText, 'parse_mode' => 'html'],
            ];

            $client->post("https://api.telegram.org/bot$apiKey/sendMessage", $param);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}

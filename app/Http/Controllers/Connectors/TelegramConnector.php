<?php

namespace App\Http\Controllers\Connectors;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use GuzzleHttp\Client;

class TelegramConnector extends Controller
{
    public function sendMessage($chatId, $messageText, $url = null)
    {
        $settings = Settings::where('parameter', 'telegram_api_key')->firstOrFail();
        $apiKey   = $settings->value;
        $client   = new Client();

        try {
            if ($url) {
                $keyboard        = [
                    'inline_keyboard' => [
                        [
                            ['text' => 'URL', 'url' => $url],
                        ],
                    ],
                ];
                $encodedKeyboard = json_encode($keyboard);

                $param = [
                    'timeout' => 5,
                    'query' => [
                        'chat_id' => $chatId,
                        'text' => $messageText,
                        'parse_mode' => 'html',
                        'reply_markup' => $encodedKeyboard,
                    ],
                ];
            } else {
                $param = [
                    'timeout' => 5,
                    'query' => ['chat_id' => $chatId, 'text' => $messageText, 'parse_mode' => 'html'],
                ];
            }

            $client->post("https://api.telegram.org/bot$apiKey/sendMessage", $param);
        } catch (\Exception $e) {
        }
    }
}

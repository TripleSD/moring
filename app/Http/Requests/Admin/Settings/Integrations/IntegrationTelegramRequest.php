<?php

namespace App\Http\Requests\Admin\Settings\Integrations;

use Illuminate\Foundation\Http\FormRequest;

class IntegrationTelegramRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'telegram_enable_status' => 'nullable|numeric',
            'telegram_api_key' => 'regex:/^\d+:\w+$/',
            'telegram_group_chat_id' => 'regex:/^-?\d+$/',
        ];
    }

    public function messages()
    {
        return [
            'telegram_api_key.regex' => 'Введите корректные данные в поле Bot API Token',
            'telegram_group_chat_id.regex' => 'Введите корректные данные в поле ChatID',
        ];
    }
}

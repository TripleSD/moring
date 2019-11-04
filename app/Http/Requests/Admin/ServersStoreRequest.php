<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ServersStoreRequest extends FormRequest
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
            'addr' => 'required|ip',
            'description' => 'alpha_dash',
            'api_token' => 'alpha_num',
            'enable' => 'nullable|numeric',
        ];
    }

    public function messages()
    {
        return [
            'addr.required' => 'Заполните поле IP адреса',
            'addr.ip' => 'Введите корректо данные в поле IP адреса'
        ];
    }
}

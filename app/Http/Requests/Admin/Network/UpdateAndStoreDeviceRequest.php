<?php

namespace App\Http\Requests\Sites;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAndStoreDeviceRequest extends FormRequest
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
            'title' => 'required | string | min:1 | max:50',
            'hostname' => 'required | string',
            'version' => 'required | integer | between:1,3',
            'port' => 'required | integer | between:1,65535',
            'community' => 'required | string | between:1,255',
            'web_url' => 'string | between:1,255 | nullable',
            'port_ssh' => 'integer | nullable',
            'port_telnet' => 'integer | nullable'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле "Описание" должно быть заполнено',
            'title.min' => 'Минимальная длина записи в поле "Описание" 3 символа',
            'title.max' => 'Максимальная длина записи в поле "Описание" 50 символов',

            'hostname.required' => 'Поле "Сетевое имя устройства или IP" адрес должно быть заполнено',
            'hostname.string' => 'Поле "Сетевое имя устройства или IP" содержит некорректные символы',

            'version.required' => 'Поле "Версия SNMP протокола" должно быть заполнено',
            'version.string' => 'Поле "Версия SNMP протокола" должно содержать только цифровые символы',
            'version.between' => 'Поле "Версия SNMP протокола" должно содержать номер протокола (1,2,3)',

            'port.required' => 'Поле "Порт SNMP" должно быть заполнено',
            'port.string' => 'Поле "Порт SNMP" должно содержать только цифровые символы',
            'port.between' => 'Поле "Порт SNMP" должно содержать номер порта (1-65535)',

            'community.required' => 'Поле "SNMP community" должно быть заполнено',
            'community.string' => 'Поле "SNMP community" содержит некорректные символы',
            'community.between' => 'Длина записи в поле "SNMP community" от 1 до 255 символов',

            'web_url.string' => 'Поле "Web консоль управления" содержит некорректные символы',
            'web_url.between' => 'Длина записи в поле "Web консоль управления" от 1 до 255 символов',

            'port_ssh.integer' => 'Поле "SSH порт" содержит некорректные символы',

            'port_telnet.integer' => 'Поле "Telnet порт" содержит некорректные символы',
        ];
    }
}

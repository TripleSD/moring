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
            'snmp_version' => 'required | integer | between:1,3',
            'snmp_port' => 'required | integer | between:1,65535',
            'snmp_community' => 'required | string | between:1,255',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Поле "Описание" должно быть заполнено',
            'title.min' => 'Минимальная длина записи в поле "Описание" 3 символа',
            'title.max' => 'Максимальная длина записи в поле "Описание" 128 символов',

            'hostname.required' => 'Поле "Сетевое имя устройства или IP" адрес должно быть заполнено',
            'hostname.string' => 'Поле "Сетевое имя устройства или IP" содержит некорректные символы',

            'snmp_version.required' => 'Поле "Версия SNMP протокола" должно быть заполнено',
            'snmp_version.string' => 'Поле "Версия SNMP протокола" должно содержать только цифровые символы',
            'snmp_version.between' => 'Поле "Версия SNMP протокола" должно содержать номер протокола (1,2,3)',

            'snmp_port.required' => 'Поле "Порт SNMP" должно быть заполнено',
            'snmp_port.string' => 'Поле "Порт SNMP" должно содержать только цифровые символы',
            'snmp_port.between' => 'Поле "Порт SNMP" должно содержать номер порта (1-65535)',

            'snmp_community.required' => 'Поле "SNMP community" должно быть заполнено',
            'snmp_community.string' => 'Поле "SNMP community" содержит некорректные символы',
            'snmp_community.between' => 'Длина записи в поле "SNMP community" от 1 до 255 символов',
        ];
    }
}

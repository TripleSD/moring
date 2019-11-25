<?php

namespace App\Http\Requests\Sites;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteRequest extends FormRequest
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
            'title' => 'required | string | min:3 | max:128',
            'url' => 'required | string | min:3 | max:128',
            'file_url' => 'nullable | string | min:4 | max:128',
            'enabled' => 'integer | max:1',
            'https' => 'integer | max:1',
            'check_https' => 'integer | max:1',
            'http_code' => 'integer | max:1',
            'use_file' => 'integer | max:1',
            'check_php' => 'integer | max:1',
            'check_ssl' => 'integer | max:1',
            'enabled' => 'integer | max:1',
            'comment' => 'nullable | max:255',
        ];
    }

    public function messages()
    {
        return [
          'title.required' => 'Поле "Название сайта" должно быть заполнено',
          'url.required' => 'Поле "Адрес URL" должно быть заполнено',
          'title.min' => 'Минимальная длина записи в поле "Название сайта" 3 символа',
          'url.min' => 'Минимальная длина записи в поле "Адрес URL" 3 символа',
          'title.max' => 'Максимальная длина записи в поле "Название сайта" 128 символов',
          'url.max' => 'Максимальная длина записи в поле "Адрес URL" 128 символов',
          'comment.max' => 'Максимальная длина записи в поле "Описание" 255 символов',
        ];
    }
}

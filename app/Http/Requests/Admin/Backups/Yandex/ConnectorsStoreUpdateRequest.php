<?php

namespace App\Http\Requests\Admin\Backups\Yandex;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ConnectorsStoreUpdateRequest.
 */
class ConnectorsStoreUpdateRequest extends FormRequest
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
            'id' => 'integer | nullable',
            'description' => 'required',
            'token' => 'required',
            'comment' => 'nullable',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Backups\Yandex;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class BucketsStoreUpdateRequest.
 */
class BucketsStoreUpdateRequest extends FormRequest
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
            'description' => 'required',
            'connector_id' => 'required',
            'comment' => 'nullable',
            'interval' => 'required | integer',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}

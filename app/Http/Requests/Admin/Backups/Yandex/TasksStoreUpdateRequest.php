<?php

namespace App\Http\Requests\Admin\Backups\Yandex;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TasksStoreUpdateRequest.
 */
class TasksStoreUpdateRequest extends FormRequest
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
            'folder' => 'nullable',
            'pre' => 'nullable',
            'post' => 'nullable',
            'filename' => 'required',
            'interval' => 'required',
            'comment' => 'nullable',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}

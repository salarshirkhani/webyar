<?php

namespace App\Http\Requests\Dashboard\Customer;

use Illuminate\Foundation\Http\FormRequest;

class TicketCreateRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:250'],
            'department' => ['required', 'string', 'max:250'],
            'content' => ['required', 'string', 'max:50000'],
            'file' => ['nullable', 'file', 'max:50000', 'mimes:jpg,jpeg,png,bmp,zip,rar,pdf'],
        ];
    }

}

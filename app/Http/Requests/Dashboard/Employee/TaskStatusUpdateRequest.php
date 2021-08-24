<?php

namespace App\Http\Requests\Dashboard\Employee;


use Illuminate\Foundation\Http\FormRequest;

class TaskStatusUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'status' => ['required', 'string'],
        ];
    }
}

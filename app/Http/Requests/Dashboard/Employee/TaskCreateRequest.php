<?php

namespace App\Http\Requests\Dashboard\Employee;


use App\Rules\JalaliDate;

class TaskCreateRequest extends TaskBaseRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'title' => ['required', 'string', 'max:250'],
            'description' => ['required', 'string'],
            'start_date' => ['required', new JalaliDate],
            'finish_date' => ['required', new JalaliDate],
        ]);
    }
}

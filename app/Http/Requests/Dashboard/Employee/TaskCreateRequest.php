<?php

namespace App\Http\Requests\Dashboard\Employee;


use App\Rules\JalaliDate;
use Carbon\Carbon;

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

    public function validated()
    {
        $data = parent::validated();
        $data['start_date'] = Carbon::fromJalali($data['start_date']);
        $data['finish_date'] = Carbon::fromJalali($data['finish_date']);
        return $data;
    }
}

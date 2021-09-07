<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\Models\Task;
use App\Rules\JalaliDate;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class TaskBaseRequest extends \App\Http\Requests\Dashboard\Employee\TaskBaseRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'employee_id' => ['required', 'exists:users,id'],
            'phase_id' => ['nullable', 'exists:phases,id'],
        ]);
    }
}

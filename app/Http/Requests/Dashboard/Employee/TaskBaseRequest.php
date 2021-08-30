<?php

namespace App\Http\Requests\Dashboard\Employee;

use App\Rules\JalaliDate;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class TaskBaseRequest extends FormRequest
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
            'status' => ['required', 'string'],
            'title' => ['required', 'string', 'max:250'],
            'description' => ['required', 'string'],
            'start_date' => ['required', new JalaliDate],
            'finish_date' => ['required', new JalaliDate],
            'start_time' => ['nullable', 'regex:/^\d{1,2}:\d{1,2}$/'],
            'finish_time' => ['nullable', 'regex:/^\d{1,2}:\d{1,2}$/'],
            'continuity' => ['nullable', 'in:1d,2d'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function (Validator $validator) {
            $data = $validator->getData();
            $data['start_date'] = Carbon::fromJalali($data['start_date']);
            $data['finish_date'] = Carbon::fromJalali($data['finish_date']);
            $validator->setData($data);

            if ($data['finish_date']->lt($data['start_date']))
                $validator->errors()->add('finish_date', 'تاریخ پایان نباید از تاریخ شروع کوچک‌تر باشد.');
        });
    }
}

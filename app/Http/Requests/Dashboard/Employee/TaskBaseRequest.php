<?php

namespace App\Http\Requests\Dashboard\Employee;

use App\Models\Task;
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
            $existing_tasks = Task
                ::where('employee_id', \Auth::user()->id)
                ->where('status', 'notwork')
                ->where(function ($q) use ($data) {
                    $q
                        ->where(function ($q) use ($data) {
                            $q
                                ->whereNull('continuity');

                            if (empty($data['continuity']))
                                $q
                                    ->where('finish_date', $data['finish_date']);
                            else
                                $q
                                    ->where('finish_date', '<=', $data['finish_date'])
                                    ->where('finish_date', '>=', $data['start_date']);
                        })
                        ->orWhere(function ($q) use ($data) {
                            if (empty($data['continuity']))
                                $q
                                    ->where('finish_date', '>=', $data['finish_date'])
                                    ->where('start_date', '<=', $data['finish_date']);
                            else
                                $q->where(function($q) use ($data) {
                                    $q
                                        ->where(function($q) use ($data) {
                                            $q
                                                ->where('start_date', '<=', $data['start_date'])
                                                ->where('finish_date', '>=', $data['start_date']);
                                        })
                                        ->orWhere(function($q) use ($data) {
                                            $q
                                                ->where('start_date', '<=', $data['finish_date'])
                                                ->where('finish_date', '>=', $data['finish_date']);
                                        })
                                        ->orWhere(function($q) use ($data) {
                                            $q
                                                ->where('start_date', '<=', $data['start_date'])
                                                ->where('finish_date', '>=', $data['finish_date']);
                                        });

                                });
                            $q
                                ->where(function ($q) {
                                    $q->whereNotNull('continuity');
                                });

                        });
                });
            if (!empty($data['start_time']) && !empty($data['finish_time']))
                $existing_tasks = $existing_tasks->where(function($q) use ($data) {
                    $q
                        ->whereNotNull('start_time')
                        ->whereNotNull('finish_time')
                        ->where('start_time', '<=', $data['finish_time'])
                        ->where('finish_time', '>=', $data['start_time']);
                });

            if (!empty($this->id))
                $existing_tasks = $existing_tasks
                    ->where('id', '!=', $this->id);

            if ($existing_tasks->count() > 0)
                $validator->errors()->add('start_date', 'در بازه زمانی مشخص‌شده مسئولیت‌های دیگری وجود دارند!');
        });
    }
}

<?php

namespace App\Http\Requests\Dashboard\Admin;


class TaskUpdateRequest extends TaskBaseRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'project_id' => ['nullable', 'exists:projects,id']
        ]);
    }
}

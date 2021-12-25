<?php

namespace App\Http\Requests\Dashboard\Admin;

class ScoreCreateRequest extends ScoreBaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'user_id' => ['required', 'exists:users,id'],
        ]);
    }

}

<?php

namespace App\Http\Requests\Dashboard\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ScoreBaseRequest extends FormRequest
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
            'description_no_textarea' => ['required', 'string', 'max:250'],
            'value' => ['required', 'numeric'],
        ];
    }

    public function validated()
    {
        $data = parent::validated();
        $data['description'] = $data['description_no_textarea'];
        unset($data['description_no_textarea']);
        return $data;
    }

}

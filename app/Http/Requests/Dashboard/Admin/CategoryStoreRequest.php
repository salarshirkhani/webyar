<?php

namespace App\Http\Requests\Dashboard\Admin;

use Illuminate\Validation\Rule;

class CategoryStoreRequest extends CategoryBaseRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'slug' => ['required', 'string', 'max:255', 'regex:/^[a-z0-9-]+$/', 'unique:categories'],
        ]);
    }
}

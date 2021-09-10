<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'type' => ['nullable', 'in:customer,owner'],
            'mobile' => ['required', 'regex:/^(09[0-9]{9})|(۰۹[۰-۹]{9})$/', Rule::unique('users')->ignoreModel(\Auth::user())],
            'password' => ['nullable', 'string', 'confirmed'],
            'picture' => ['nullable', 'file', 'mimes:jpg,jpeg,png'],
        ];
        if (\Auth::user()->type == 'customer') {
            $rules = array_merge($rules, [
                'second_mobile' => ['nullable', 'regex:/^(09[0-9]{9})|(۰۹[۰-۹]{9})$/'],
                'whatsapp_number' => ['nullable', 'regex:/^(09[0-9]{9})|(۰۹[۰-۹]{9})$/'],
                'instagram_page' => ['nullable', 'string'],
                'telegram_channel' => ['nullable', 'string'],
                'landline' => ['nullable', 'regex:/^0[0-9]+$/'],
                'address' => ['nullable', 'string'],
                'referral' => ['nullable', 'string'],
            ]);
        }
        return $rules;
    }

    public function validated() {
        $data = parent::validated();
        if (empty($data['password']))
            unset($data['password']);
        else
            $data['password'] = \Hash::make($data['password']);
        return $data;
    }
}

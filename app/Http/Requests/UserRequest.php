<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules = [
            'username' => ['required', 'alpha_num', 'min:3', 'max:30', Rule::unique('users')->ignore($this->user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user->id)],
            'password' => ['required', 'min:5', 'max:20', 'confirmed'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $rules['password'] = ['sometimes', 'min:5', 'max:20', 'confirmed'];
        }

        return $rules;
    }
}

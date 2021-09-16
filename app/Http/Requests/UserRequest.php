<?php

namespace App\Http\Requests;

use App\Models\Address;
use App\Models\Recruiter;
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
        return [
            'username' => ['required', 'alpha_num', 'min:3', 'max:30'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:5', 'max:20', 'confirmed'],
        ];
    }
}

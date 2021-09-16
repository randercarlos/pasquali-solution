<?php

namespace App\Http\Requests;

use App\Models\Recruiter;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:100'],
            'cpf' => ['required', 'cpf'],
            'rg' => ['required', 'min:12', 'max:12'], //21.275.738-4
            'birth' => ['required', 'date'],
            'email' => ['required', 'email'],
            'user_id'  => ['required', 'integer', 'exists:users,id'],
        ];
    }
}

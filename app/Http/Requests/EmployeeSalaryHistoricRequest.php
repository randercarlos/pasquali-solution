<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeSalaryHistoricRequest extends FormRequest
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
            'address' => ['required', 'min:5', 'max:200'],
            'number' => ['required', 'min:1', 'max:15'],
            'city' => ['required', 'min:3', 'max:30'],
            'state' => ['required', 'size:2'],
            'postalCode' => ['required', 'size:8'],
            'employee_id'  => ['required', 'integer', 'exists:employees'],
        ];
    }
}

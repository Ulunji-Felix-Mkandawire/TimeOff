<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string' ,'min:3', 'max:100'],
            'email' => ['required', 'email', 'max:255', 'unique:employees,email'],
            'department_id' => ['required', 'exists:departments,id'],
            // Can have no manager but if is to have manager, make sure that manager is not deleted
            // Hence the deleted_at column must be null
            'manager_id' => ['nullable', Rule::exists('employees', 'id')->whereNull('deleted_at')]
        ];
    }
}

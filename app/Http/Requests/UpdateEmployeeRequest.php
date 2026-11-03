<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
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
        // Grab the router parameter/wildcard
        $employee = $this->route('employee');

        /**
         * By using ->ignore($employee), you are telling Laravel: "Check if this email is unique, but
         * ignore the employee we are currently editing. It is perfectly fine if the email matches
         * their own current record."
         * 
         * By grabbing the $employee from the route, you can get their ID using $employee->id. The
         * notIn rule tells Laravel: "Make sure whatever ID the user selects for the manager_id field
         * is not equal to this current employee's ID."
         */
        return [
                'name' => ['required', 'string', 'min:3', 'max:100'],
                'email' => ['required', 'email', 'max:255',
                    Rule::unique('employees', 'email')->ignore($employee)],
                'department_id' => ['required', 'exists:departments,id'],
                'manager_id' => ['nullable',
                    Rule::exists('employees', 'id')->whereNull('deleted_at')->whereNull('manager_id'),
                    Rule::notIn([$employee->id])],
            ];
    }
}

<?php

namespace App\Http\Requests\Webapp;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'branch_id' => ['required', 'exists:branches,id'],
            'position_id' => ['required', 'exists:positions,id'],
            'last_name' => ['required', 'min:3', 'max:64'],
            'hire_date' => ['required', 'date'],
        ];
        if ($this->isMethod('post')) {
            $rules += [
                'first_name' => [
                    'required', 'min:3', 'max:32',
                    Rule::unique('employees')
                        ->where('first_name', $this->first_name)
                        ->where('last_name', $this->last_name)
                ],
                'employee_id_number' => ['unique:employees,employee_id_number', ' nullable'],
            ];
        } else {
            $rules += [
                'first_name' => [
                    'required', 'min:3', 'max:32',
                    Rule::unique('employees')
                        ->ignore($this->id)
                        ->where('first_name', $this->first_name)
                        ->where('last_name', $this->last_name)
                ],
                'employee_id_number' => 'nullable| unique:employees,employee_id_number,' . $this->id,
            ];
        }

        return $rules;
    }
}

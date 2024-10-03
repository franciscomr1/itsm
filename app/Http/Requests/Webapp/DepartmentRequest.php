<?php

namespace App\Http\Requests\Webapp;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
        $rules = [];
        if ($this->isMethod('post')) {
            $rules += [
                'name' => ['required', 'min:3', 'max:64', 'unique:departments'],
                'cost_center' => ['required','numeric',  'min:1000', 'max:99999999', 'unique:departments,cost_center'],
            ];
        } else {
            $rules += [
                'name' => ['required', 'min:3', 'max:64', 'unique:departments,id,' . $this->id],
                'cost_center' => ['required','numeric',  'min:1000', 'max:999999999', 'unique:departments,cost_center,' . $this->id],
            ];
        }

        return $rules;
    }
}

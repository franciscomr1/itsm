<?php

namespace App\Http\Requests\Webapp;

use Illuminate\Foundation\Http\FormRequest;

class PositionRequest extends FormRequest
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
            'department_id' => ['required', 'exists:departments,id'],
        ];
        if ($this->isMethod('post')) {
            $rules += [
                'name' => ['required', 'min:3', 'max:64', 'unique:positions'],
            ];
        } else {
            $rules += [
                'name' => ['required', 'min:3', 'max:64', 'unique:positions,id,' . $this->id],
            ];
        }

        return $rules;
    }
}

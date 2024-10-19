<?php

namespace App\Http\Requests\Webapp;

use Illuminate\Foundation\Http\FormRequest;

class RequestTypeRequest extends FormRequest
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
            'issue_type_id' => ['required', 'exists:issue_types,id'],
            'request_category_id' => ['required', 'exists:request_categories,id'],
        ];
        if ($this->isMethod('post')) {
            $rules += [
                'name' => ['required', 'min:3', 'max:64', 'unique:request_types'],
            ];
        } else {
            $rules += [
                'name' => ['required', 'min:3', 'max:64', 'unique:request_types,id,' . $this->id],
            ];
        }

        return $rules;
    }
}

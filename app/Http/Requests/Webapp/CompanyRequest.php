<?php

namespace App\Http\Requests\Webapp;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'address' => ['required', 'min:3', 'max:96'],
            'city' => ['required', 'min:3', 'max:32'],
            'state' => ['required', 'min:3', 'max:32'],
            'city' => ['required', 'min:3', 'max:32'],
            'postal_code' => ['required', 'digits:5']
        ];
        if ($this->isMethod('post')) {
            $rules += [
                'name' => ['required', 'min:3', 'max:32', 'unique:companies'],
                'business_name' => ['required',  'min:3', 'max:64', 'unique:companies,business_name'],
            ];
        } else {
            $rules += [
                'name' => ['required', 'min:3', 'max:32', 'unique:companies,id,' . $this->id],
                'business_name' => ['required',  'min:3', 'max:64', 'unique:companies,business_name,' . $this->id],
            ];
        }

        return $rules;
    }

}

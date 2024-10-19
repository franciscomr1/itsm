<?php

namespace App\Http\Requests\Webapp;

use Illuminate\Foundation\Http\FormRequest;

class ManufacturerRequest extends FormRequest
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
                'name' => ['required', 'min:3', 'max:32', 'unique:manufacturers'],
            ];
        } else {
            $rules += [
                'name' => ['required', 'min:3', 'max:32', 'unique:manufacturers,id,' . $this->id],
            ];
        }

        return $rules;
    }
}

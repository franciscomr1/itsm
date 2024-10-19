<?php

namespace App\Http\Requests\Webapp;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
            'provider_id' => 'required | exists:providers,id',
            'invoice_date' => ['required', 'date'],
            'warranty_start_date' => ['required', 'date'],
            'warranty_expiration_date' => ['required', 'date'],
            'purchase_order' => ['required', 'min:3', 'max:32'],
            'purchase_date' => ['required', 'date'],
        ];
        if ($this->isMethod('post')) {
            $rules += [
                'name' => ['required', 'min:3', 'max:32', 'unique:contracts'],
                'invoice_number' => ['required', 'min:3', 'max:32', 'unique:contracts'],
            ];
        } else if ($this->isMethod('patch')) {
            $rules += [
                'name' => ['required', 'min:3', 'max:32', 'unique:contracts,name,' . $this->id],
                'invoice_number' => ['required', 'min:3', 'max:32', 'unique:contracts,invoice_number,' . $this->id],
            ];
        }

        return $rules;
    }
}

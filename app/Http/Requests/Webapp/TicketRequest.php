<?php

namespace App\Http\Requests\Webapp;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
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
            'subject' => ['required', 'min:3', 'max:64'],
            'description' => ['required', 'min:3', 'max:1024'],
            'issue_type_id' => ['nullable', 'exists:issue_types,id'],
            'request_type_id' => ['nullable', 'exists:request_types,id'],
            'request_status_id' => ['nullable', 'exists:request_statuses,id'],
            'urgency_level_id' => ['required', 'exists:urgency_levels,id'],
            'priority_level_id' => ['nullable', 'exists:priority_levels,id'],
            'request_channel_id' => ['nullable', 'exists:request_channels,id'],
            'employee_id' => ['nullable', 'exists:employees,id'],
        ];


        return $rules;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TimeLogRequest extends FormRequest
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
        return [
            'user_id' => ['required'],
            'date' => ['required'],
            'working_hours.*' => ['required', Rule::notIn(['00:00']),],
            'description.*' => ['required', 'min:20', 'max:500']
        ];
    }

    public function messages(): array
    {
        return [
            'working_hours.*.required' => 'The working hours field is required.',
            'working_hours.*.not_regex' => 'The working hours field is invalid.',
            'description.*.required' => 'The description field is required.',
            'description.*.min' => 'The description field must be at least 20 characters.',
            'description.*.max' => 'The description field must not be greater than 500 characters.'
        ];
    }
}

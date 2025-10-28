<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Step1Request extends FormRequest
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
            'title' => 'required|string|max:255',
            'objective' => 'required|string|max:50',
            'description' => 'required|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Campaign title is required.',
            'title.max' => 'Campaign title must not exceed 255 characters.',
            'objective.required' => 'Campaign objective is required.',
            'objective.max' => 'Campaign objective must not exceed 50 characters.',
            'description.required' => 'Campaign description is required.',
            'start_date.required' => 'Start date is required.',
            'start_date.after_or_equal' => 'Start date must be today or later.',
            'end_date.required' => 'End date is required.',
            'end_date.after' => 'End date must be after start date.'
        ];
    }
}
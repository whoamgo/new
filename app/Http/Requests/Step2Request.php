<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Step2Request extends FormRequest
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
            'age_group' => 'required|array|min:1',
            'age_group.*' => 'required|string',
            'gender' => 'required|array|min:1',
            'gender.*' => 'required|string',
            'region' => 'required|array|min:1',
            'region.*' => 'required|string',
            'country' => 'required|array|min:1',
            'country.*' => 'required|string',
            'state' => 'required|array|min:1',
            'state.*' => 'required|string',
            'city' => 'required|array|min:1',
            'city.*' => 'required|string'
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
            'age_group.required' => 'Please select at least one age group.',
            'age_group.array' => 'Age group must be an array.',
            'age_group.min' => 'Please select at least one age group.',
            'gender.required' => 'Please select at least one gender.',
            'gender.array' => 'Gender must be an array.',
            'gender.min' => 'Please select at least one gender.',
            'region.required' => 'Please select at least one region.',
            'region.array' => 'Region must be an array.',
            'region.min' => 'Please select at least one region.',
            'country.required' => 'Please select at least one country.',
            'country.array' => 'Country must be an array.',
            'country.min' => 'Please select at least one country.',
            'state.required' => 'Please select at least one state.',
            'state.array' => 'State must be an array.',
            'state.min' => 'Please select at least one state.',
            'city.required' => 'Please select at least one city.',
            'city.array' => 'City must be an array.',
            'city.min' => 'Please select at least one city.'
        ];
    }
}
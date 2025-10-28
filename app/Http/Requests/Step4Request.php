<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Step4Request extends FormRequest
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
            'ads_file' => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:5120', // 5MB max
            'action_url' => 'required|url|max:255'
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
            'ads_file.required' => 'Ad file is required.',
            'ads_file.file' => 'Ad file must be a valid file.',
            'ads_file.mimes' => 'Ad file must be an image (jpg, jpeg, png, gif, webp).',
            'ads_file.max' => 'Ad file size must not exceed 5MB.',
            'action_url.required' => 'Call-to-action link is required.',
            'action_url.url' => 'Call-to-action link must be a valid URL.',
            'action_url.max' => 'Call-to-action link must not exceed 255 characters.'
        ];
    }
}
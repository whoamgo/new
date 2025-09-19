<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class Step4Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ads_file' => ['nullable', 'file', 'max:5120'],
            'action_url' => ['required', 'url', 'max:255'],
        ];
    }
}


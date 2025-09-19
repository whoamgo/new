<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class Step3Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ads_place_type' => ['required', 'string', 'max:45'],
            'ads_position' => ['required', 'string', 'max:45'],
            'budget_type' => ['required', 'string', 'max:45'],
            'amount' => ['required', 'numeric', 'min:0'],
        ];
    }
}


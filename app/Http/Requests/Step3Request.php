<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Step3Request extends FormRequest
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
            'ads_place_type' => 'required|string|in:Banner,Popup,Video,Text',
            'ads_position' => 'required|string|in:Top,Right,Bottom,Left,Center',
            'budget_type' => 'required|string|in:Daily,Weekly,Monthly,Halfyearly,Yearly',
            'amount' => 'required|numeric|min:0.01|max:999999.99'
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
            'ads_place_type.required' => 'Advertisement mode is required.',
            'ads_place_type.in' => 'Please select a valid advertisement mode.',
            'ads_position.required' => 'Ads placement is required.',
            'ads_position.in' => 'Please select a valid ads placement.',
            'budget_type.required' => 'Budget type is required.',
            'budget_type.in' => 'Please select a valid budget type.',
            'amount.required' => 'Amount is required.',
            'amount.numeric' => 'Amount must be a valid number.',
            'amount.min' => 'Amount must be at least $0.01.',
            'amount.max' => 'Amount must not exceed $999,999.99.'
        ];
    }
}
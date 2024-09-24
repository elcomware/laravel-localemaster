<?php

namespace Elcomware\LocaleMaster\Http;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LocaleRequest extends FormRequest
{
    public function authorize(): true
    {
        return Auth::check(); // Adjust based on your authorization logic
    }

    public function rules(): array
    {
        return [
            'code' => 'required|string|size:3|unique:currencies,code',
            'name' => 'required|string|max:255',
            'native_name' => 'nullable|string|max:255',
            'direction' => 'required|in:l,r', // Assuming 'l' for left and 'r' for right
            'flag' => 'nullable|url', // Assuming the flag is a URL to an image
            'identifier' => 'nullable|string|max:10',
            'decimal_separator' => 'required|string|max:2',
            'precision' => 'required|integer|min:0|max:5', // Assuming max precision of 4
            'thousand_separator' => 'required|string|max:2',
            'currency_symbol' => 'required|string|max:10',
            'currency_name' => 'required|string|max:25',
            'currency_first' => 'required|boolean',
            'is_active' => 'required|boolean',
            'is_default' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'The currency code is required.',
            'code.size' => 'The currency code must be exactly 3 characters.',
            'code.unique' => 'This currency code already exists.',
            'direction.required' => 'The direction is required.',
            'direction.in' => 'The direction must be either "l" (left) or "r" (right).',
            // Add other custom messages as needed
        ];
    }
}

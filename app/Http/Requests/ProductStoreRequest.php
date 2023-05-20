<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'categories_id' => 'required|numeric',
            'name' => 'required|max:255',
            'min_value_for_purchase' => 'required|numeric',
            'price' => 'required|numeric',
            'price_for_what' => 'required|in:one piece,kg',
            'available' => 'required'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartRequest extends FormRequest
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
            'product_id' => 'integer',
            'quantity' => 'integer|not_in:0',
            'product' => 'array|not_in:0|min:1',
            'product.*' => ['integer', Rule::exists('products', 'id')],
            'quantity_'=> 'array|not_in:0|min:1',
            'quantity_*' => 'integer|not_in:0',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.integer' => 'Mana id produknya??',
            'quantity.integer' => 'Masukin jumlah ga niiii?',
            'quantity.not_in' => 'Jangan 0 lah tololll',
            'product.array' => 'Harus berupa array',
            'product.not_in' => 'Jangan 0 lah tololll',
            'product.min' => 'Jangan 0 blokkk',
            'product.*.integer' => 'Kasih nilai lahhh',
        ];
    }
}

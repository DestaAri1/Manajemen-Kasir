<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|not_in:0'
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Produk tidak boleh kosong',
            'product_id.integer' => 'Mana id produknya??',
            'quantity.required' => 'Jumlah tidak boleh kosong',
            'quantity.integer' => 'Masukin jumlah ga niiii?',
            'quantity.not_in' => 'Jangan 0 lah tololll'
        ];
    }
}

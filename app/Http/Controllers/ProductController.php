<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    private $rules = [
        'product' => 'required|string|max:255',
        'stock' => 'required|integer',
        'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|not_in:0',
        'image' => 'mimes: jpeg, jpg, png', 'max:2048'
    ];

    private $message = [
        'product.required' => 'Produk tidak boleh kosong',
        'product.string' => 'Nama produk haruslah string',
        'product.max' => 'Maksimal kata adalah 255',
        'stock.required' => 'Kolom stok harus diisi',
        'stock.integer' => 'Kolom stok harus berupa angka',
        'price.required' => 'Kolom harga harus diisi',
        'price.regex' => 'Kolom harga harus berupa angka. Contoh 10000',
        'price.not_in' => 'Kolom harga tidak boleh angka 0',
        'image.mimes' => 'Format yang diterima hanyalah .JPG, .JPEG, .PNG',
        'image.max' => 'Ukuran gambar maksimal adalah 2mb'
    ];

    public function index()
    {
        return view('product.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->message);

        if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors())->withInput();
		}

		$fields = $validator->validated();

        // if (!$fields) {
        //     return redirect()->back()->with('error', 'Validasi Gagal');
        // }

        $form_data = [
            'user_id' => $request->user()->id,
            'products' => $request->product,
            'stock' => $request->stock,
            'price' => $request->price,
        ];

        $produk = Product::create($form_data);

        if ($produk) {
            return redirect()->back()->with('success', 'Produk berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Produk gagal disimpan');
        }

    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }

    public function destroy(Product $product)
    {
        //
    }
}

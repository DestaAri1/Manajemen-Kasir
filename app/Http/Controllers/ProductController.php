<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private $rules = [
        'product' => 'required|string|max:255',
        'stock' => 'required|integer|not_in:0',
        'price' => 'required|regex:/^\d+(\.\d{1,2})?$/|not_in:0',
        'image' => 'mimes: jpeg, jpg, png', 'max:2048',
    ];

    private $message = [
        'product.required' => 'Produk tidak boleh kosong',
        'product.string' => 'Nama produk haruslah string',
        'product.max' => 'Maksimal kata adalah 255',
        'stock.required' => 'Kolom stok harus diisi',
        'stock.integer' => 'Kolom stok harus berupa angka',
        'stock.not_in' => 'Jumlah stock tidak boleh 0',
        'price.required' => 'Kolom harga harus diisi',
        'price.regex' => 'Kolom harga harus berupa angka. Contoh 10000',
        'price.not_in' => 'Tidak boleh menuliskan 0 untuk harga',
        'image.mimes' => 'Format yang diterima hanyalah .JPG, .JPEG, .PNG',
        'image.max' => 'Ukuran gambar maksimal adalah 2mb'
    ];

    public function index()
    {
        $produk = Product::where('user_id', Auth::user()->id)->paginate(6);
        return view('product.index', compact('produk'));
    }

    public function updateStock(Request $request, $id)
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

        if (!$fields) {
            return redirect()->back()->with('error', 'Validasi Gagal');
        }

        $form_data = [
            'user_id' => $request->user()->id,
            'products' => $request->product,
            'stock' => $request->stock,
            'price' => $request->price,
        ];

        $produk = Product::create($form_data);

        $form_data2 = [
            'product' => $produk->products,
            'type' => 0,
            'amount' => $request->stock,
            'price' => $produk->price,
            'user_id' => $request->user()->id,
        ];

        History::create($form_data2);

        if ($produk) {
            return redirect()->back()->with('success', 'Produk berhasil disimpan');
        } else {
            return redirect()->back()->with('error', 'Produk gagal disimpan');
        }

    }

    public function edit($id)
    {
        try {

            $decryptedId = Crypt::decryptString($id);
            if (!$decryptedId) {
                return redirect()->back()->with('error', 'Url tidak ditemukan');
            }
            $getId = Product::findOrFail($decryptedId);
            if ($getId) {
                return view('product.edit', compact('getId'));
            } else {
                return redirect()->route('product')->with('error', 'Url tidak ditemukan');
            }
        } catch (DecryptException $e) {
            return view('errors.404');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $validator = Validator::make($request->all(), $this->rules, $this->message);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $fields = $validator->validated();

            if (!$fields) {
                return redirect()->back()->with('error', 'Validasi Gagal');
            }

            $produk = Product::findOrFail($decryptedId);

            $form_data = [
                'user_id' => $request->user()->id,
                'products' => $request->product,
                'stock' => $request->stock,
                'price' => $request->price,
            ];

            $update_produk = $produk->update($form_data);

            $form_data2 = [
                'product' => $produk->products,
                'type' => 2,
                'amount' => $request->stock,
                'price' => $produk->price,
                'user_id' => $request->user()->id,
            ];

            History::create($form_data2);

            if ($update_produk) {
                return redirect()->route('product')->with('success', 'Data berhasil diupdate');
            } else {
                return redirect()->back()->with('error', 'Data gagal diupdate');
            }

        } catch (DecryptException $e) {
            return view('errors.404');
        }
    }

    public function destroy($id)
    {
        $produk = Product::findOrFail($id);
        if ($produk->delete()) {
            return redirect()->back()->with('success', 'Data Berhasil Dihapus');
        } else {
            return redirect()->back()->with('error', 'Data Gagal Dihapus');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_promo;
use App\Models\Promo;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    private $rules = [
        'name' => 'required|string|max:255',
        'promo' => 'required|array|min:1|max:5',
        'promo.*' => 'required|integer|max:255',
        'add' => 'required|array|min:1|max:5',
        'add.*' => 'required|integer|max:255',
        'category' => 'required|boolean',
        'value' => 'required|numeric'
    ];

    private $message = [
        'name.required' => 'Kolom nama harus diisi',
        'name.string' => 'Kolom nama harus berupa string',
        'name.max' => 'Maksimal kata yang bisa diisikan yaitu 255 kata',
        'promo.required' => 'Kolom produk harus diisi',
        'promo.array' => 'Kolom produk harus berupa array',
        'promo.min' => 'Kolom produk minimal terdapat 1 buah',
        'promo.max' => 'Kolom produk maksimal terdapat 5 buah',
    ];

    public function index()
    {
        $promo = Promo::where('user_id', Auth::user()->id)->with([
            'productPromos',
        ])->paginate(6);
        // dd($promo);
        return view('promo.index', compact('promo'));
    }

    public function create(Request $request)
    {
        $produk = Product::where('user_id', $request->user()->id)->orderBy('products', 'asc')->get();
        return view('promo.create', compact('produk'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules, $this->message);

        // Kondisional Validasi
        if ($request->category == 1 && $request->value>100) {
            $validator->after(function ($validator) use ($request) {
                if ($request->category == 1 && $request->value>100) {
                    $validator->errors()->add('diskon', 'Diskon tidak boleh lebih dari 100%');
                }
            });
        }

        if ($validator->fails()) {
			return redirect()->back()->withErrors($validator->errors())->withInput();
		}

		$fields = $validator->validated();

        if (!$fields) {
            return redirect()->back()->with('error', 'Validasi Gagal');
        }

        $form_data = [
            'name' => $request->name,
            'type' => $request->category,
            'value' => $request->value,
            'user_id' => $request->user()->id,
        ];

        $promo = Promo::create($form_data);

        foreach ($request->input('promo') as $key => $value) {
            $form_promo = [
                'product_id' => $request->input('promo')[$key],
                'amount' => $request->input('add')[$key],
                'promo_id' => $promo->id
            ];
            $product_promo = Product_promo::create($form_promo);
        }

        if (!$promo || !$product_promo) {
            return redirect()->route('promo')->with('error', 'Promo gagal dibuat');
        } else {
            return redirect()->route('promo')->with('success', 'Promo berhasil dibuat');
        }
    }

    public function show(Promo $promo)
    {
        //
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $promo = Promo::where('user_id', Auth::user()->id)->with([
                'productPromos',
            ])->findOrFail($decryptedId);
            $produk = Product::where('user_id', Auth::user()->id)->get();
            return view('promo.edit', compact('promo', 'produk'));
        } catch (DecryptException $e) {
            return view('errors.404');
        }
    }

    public function update(Request $request, Promo $promo)
    {
        //
    }

    public function destroy($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $promo = Promo::findOrFail($decryptedId);
            if ($promo->delete()) {
                return redirect()->back()->with('success', 'Promo Berhasil Dihapus');
            } else {
                return redirect()->back()->with('error', 'Promo Gagal Dihapus');
            }
        } catch (DecryptException $e) {
            return view('errors.404');
        }
    }
}

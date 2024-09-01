<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function store(CartRequest $request) {
        $validate = $request->validated();
        $userId = Auth::id(); // Mengambil user_id langsung dari Auth helper

        $cart = Cart::where('user_id', $userId)
                    ->where('product_id', $request->product_id)
                    ->first();

        $data = array_merge($validate, [
            'user_id' => $userId,
        ]);

        if ($cart) {
            $data['quantity'] = $cart->quantity + $request->quantity;
            $cart->update($data);
        } else {
            $cart = Cart::create($data);
        }

        $message = $cart ? 'Berhasil Dimasukkan Kedalam Keranjang' : 'Gagal Dimasukkan Kedalam Keranjang';

        return redirect()->route('dashboard', ['scrollPosition' => session()->get('scrollPosition')])
                        ->with($cart ? 'success' : 'error', $message);
    }

    public function update(CartRequest $request) {
        $validate = $request->validated();

        if ($validate) {
            // Ambil input promo dan product, pastikan array atau beri nilai default
            $promoIds = $request->input('promo', []);
            $productIds = $request->input('product', []);

            // Periksa apakah promo atau product ada
            $carts = Cart::where('user_id', $request->user()->id)
                ->where(function ($query) use ($promoIds, $productIds) {
                    if (!empty($promoIds)) {
                        $query->whereIn('promo_id', $promoIds);
                    }
                    if (!empty($productIds)) {
                        $query->orWhereIn('product_id', $productIds);
                    }
                })
                ->get();

            foreach ($carts as $key => $cart) {
                $form = ['quantity' => $request->quantity_[$key]];
                $cart->update($form);
            }
        }

        $message = $cart ? '' : 'Gagal Masuk ke halaman pembayaran';

        return redirect()->route($cart ? 'pembayaran' : 'home')
                         ->with($cart ? '' : 'error', $message);
    }

    public function destroy($id)
    {
        $promo_produk = Cart::findOrFail($id);
        $promo_produk->delete();
        return response()->json(['success' => 'Keranjang berhasil dihapus!']);
    }
}

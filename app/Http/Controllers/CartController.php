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

    public function destroy(Cart $cart)
    {
        //
    }
}

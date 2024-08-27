<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use PhpParser\Node\Stmt\Return_;

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
            $carts = Cart::where('user_id', $request->user()->id)
                ->whereIn('product_id', $request->input('product'))
                ->get();
            foreach ($carts as $key => $cart) {
                $form = ['quantity' => $request->quantity_[$key],];
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

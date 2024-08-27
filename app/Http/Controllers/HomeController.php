<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promo = Promo::where('user_id', Auth::user()->id)->with([
            'productPromos',
        ])->get();
        $produk = Product::where('user_id', Auth::user()->id)->get();
        $cart = Cart::where('user_id', Auth::user()->id)
                ->with(['product'])
                ->get();
        if (session()->has('scrollPosition')) {
            return view('home.index', ['scrollPosition' => session()->get('scrollPosition'), 'promo', 'produk', 'cart']);
        }
        return view('home.index', compact('promo', 'produk', 'cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $searchInput = $request->input('query');
        $products = Product::where('products', 'LIKE', "%{$searchInput}%")->get();

        return response()->json($products);
    }
}

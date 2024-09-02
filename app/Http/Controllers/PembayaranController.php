<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\History;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    private $userId;
    private $cart;

    public function __construct()
    {
        $this->userId = Auth::id();
        $this->cart = Cart::where('user_id', $this->userId)
                            ->with(['product', 'promo', 'promo.productPromos.product'])
                            ->get();
    }

    public function index(Request $request)
    {
        $cart = $this->cart;
        return view('pembayaran.index', compact('cart'));
    }

    public function store(Request $request)
    {
        $amount = str_replace(['Rp ', '.'], '', $request->input('amount'));
        $amount = is_numeric($amount) ? ltrim($amount, '0') : 0;

        $total_harga = $request->total_price;
        $diskon = $request->total_discount;
        $selisih = $total_harga - $amount;

        if ($total_harga > $amount) {
            return redirect()->back()->with('amount_error', "Uang yang anda bayarkan kurang Rp. " . formatRupiah($selisih));
        }

        $cart = $this->cart;
        $total_keranjang = 0;

        foreach ($cart as $data) {
            $product = $data->product;
            $promo = $data->promo;

            if ($promo && $promo->productPromos->isNotEmpty()) {
                $total_keranjang += $promo->productPromos->sum('amount');
            }
        }

        $produk = Product::where('user_id', $this->userId)
                           ->whereIn('id');

        // Process each cart item
        foreach ($cart as $data) {
            $product = $data->product;
            $promo = $data->promo;

            if ($promo && $promo->productPromos->isNotEmpty()) {
                foreach ($promo->productPromos as $productPromo) {
                    $total_barang = $productPromo->amount * $data->quantity;
                    $jumlah_total_barang = $total_keranjang * $data->quantity;
                    $diskon_per_produk = number_format(floor($diskon / $jumlah_total_barang), 1, '.', '');
                    $harga_produk = $productPromo->product->price - $diskon_per_produk;

                    // Save data to database
                    // History::create([
                    //     'product' => $productPromo->product->products,
                    //     'promo' => $promo->name,
                    //     'amount' => $total_barang,
                    //     'price' => $harga_produk,
                    // ]);
                    $id = $productPromo->product->id;
                }
            } else {
                if ($product) {
                    // History::create([
                    //     'product' => $product->products,
                    //     'promo' => null,
                    //     'amount' => $data->quantity,
                    //     'price' => $product->price,
                    // ]);
                }
            }
        }
    }

}

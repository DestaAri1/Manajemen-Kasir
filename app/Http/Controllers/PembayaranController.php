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
        if ($cart->count() == null) {
            return redirect()->route('dashboard');
        } else {
            return view('pembayaran.index', compact('cart'));
        }
    }

    public function store(Request $request)
    {
        $amount = str_replace(['Rp ', '.'], '', $request->input('amount'));
        $amount = is_numeric($amount) ? ltrim($amount, '0') : 0;

        $total_harga = $request->total_price;
        $diskon = $request->total_discount;
        $selisih = $total_harga - $amount;

        $kembalian = $amount - $total_harga;

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
                foreach ($promo->productPromos as $productPromo) {
                    $total_barang = $productPromo->amount * $data->quantity;

                    if ($productPromo->product->stock - $total_barang < 0) {
                        return redirect()->back()->with('error', 'Stok produk ' . $productPromo->product->products . ' tidak mencukupi.');
                    }
                }
            } else {
                if ($product && $product->stock - $data->quantity < 0) {
                    return redirect()->back()->with('error', 'Stok produk ' . $product->products . ' tidak mencukupi.');
                }
            }
        }

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

                    $product = $productPromo->product;

                    $produk_sekarang = $product->stock - $total_barang;

                    // Save data to database
                    History::create([
                        'product' => $productPromo->product->products,
                        'type' => 3,
                        'promo' => $promo->name,
                        'amount' => $total_barang,
                        'price' => $harga_produk,
                        'user_id'=>$this->userId
                    ]);

                    $product->update(['stock' => $produk_sekarang]);
                }
            } else {
                if ($product) {
                    $total_produk = $product->stock - $data->quantity;
                    History::create([
                        'product' => $product->products,
                        'type' => 3,
                        'promo' => null,
                        'amount' => $data->quantity,
                        'price' => $product->price,
                        'user_id'=>$this->userId
                    ]);

                    $product->update(['stock' => $total_produk]);
                }
            }
            $data->delete();
        }

        return redirect()->route('dashboard')->with('success', 'Pembayaran berhasil, kembalian anda Rp. '.formatRupiah($kembalian));
    }

}

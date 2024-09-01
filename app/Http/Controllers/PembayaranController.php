<?php

namespace App\Http\Controllers;

use App\Models\Cart;
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
                            ->with(['product', 'promo'])
                            ->get();
    }

    public function index(Request $request)
    {
        $cart = $this->cart;
        return view('pembayaran.index', compact('cart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $amount = str_replace(['Rp ', '.'], '', $request->input('amount'));
        dd($amount);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
    $TotalPrice = $request->input('total_price');
    $cartItems = auth()->user()->cartItems()->with(['user', 'product'])->get();

    return view('checkout.index', [
        'TotalPrice' => $TotalPrice,
        'cartItems' => $cartItems,
    ]);
    }
}

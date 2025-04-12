<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
    $TotalPrice = $request->input('total_price');
    session(['TotalPrice' => $TotalPrice]);
    $cartItems = auth()->user()->cartItems()->with(['user', 'product'])->get();

    return view('checkout.index', [
        'TotalPrice' => $TotalPrice,
        'cartItems' => $cartItems,
    ]);
    }

    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'zipcode' => 'required|string|regex:/^\d{3}-?\d{4}$/',
        ]);

        $user = auth()->user();
        $user->address = $validated['address'];
        $user->zipcode = $validated['zipcode'];
        $user->save();

        $TotalPrice = session('TotalPrice');
        $cartItems = auth()->user()->cartItems()->with(['user', 'product'])->get();

        return view('checkout.index', [
            'TotalPrice' => $TotalPrice,
            'cartItems' => $cartItems,
        ]);
    }
}

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

    public function updateAddress(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->address = $validated['address'];
        $user->save();

        return redirect()->back();
    }
}

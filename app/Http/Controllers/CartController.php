<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;


class CartController extends Controller
{
    //indexに商品情報を表示
    public function index()
    {
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        $TotalPrice = $this->calculateTotalPrice($cartItems);
        return view('cart.index', compact('cartItems', 'TotalPrice'));
    }

    //カートに商品を追加
    public function store(Request $request)
    {
        $request->validate([
        'product_id' => 'required|exists:products,id', 
        'quantity' => 'required|integer|min:1', 
    ]);
    auth()->user()->cartItems()->create([
        'product_id' => $request->product_id,
        'quantity' => $request->quantity,
    ]);
    return redirect()->route('cart.index')->with('success', '商品をカートに追加しました！');
    }

    //削除機能
    public function destroy($id)
    {
        $cartItem = auth()->user()->cartItems()->findOrFail($id);
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', '商品を削除しました。');
    }

    //料金合計
    public function calculateTotalPrice()
    {
        $TotalPrice = 0;
        $cartItems = auth()->user()->cartItems()->with('product')->get();
        foreach ($cartItems as $cartItem) {
            $price = $cartItem->product->price;
            $quantity = $cartItem->quantity;
            $TotalPrice += $price * $quantity;
        }
        return $TotalPrice;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class PurchaseController extends Controller
{
    public function confirmation(Request $request)
    {
        $totalPrice = $request->query('totalPrice');
        $id = null;

        if ($totalPrice == 0) {
            $id = 1;
        } elseif ($totalPrice > 0 && $totalPrice <300000) {
            $id = 2;
        } elseif ($totalPrice >= 300000 && $totalPrice <600000) {
            $id = 3;
        } elseif ($totalPrice >= 600000) {
            $id = 4;
        } else {
            $id = null;
        }

        $character = DB::table('characters')->find($id);
        if (!$character) {
            $character = (object) [
                'name' => '冨野由悠季',
                'comment' => '原作者は伊達じゃない！',
                'img_path' => 'Tomino.jpg',
            ];
        }
        $this->clearCart();
        return view('purchase-confirmation.index', [
                'totalPrice' => $totalPrice,
                'character' => $character, 
        ]);   
    }

    private function clearCart()
    {
        $cartItems = auth()->user()->cartItems;
        foreach ($cartItems as $item) {
        $item->delete();
        }
    }
}

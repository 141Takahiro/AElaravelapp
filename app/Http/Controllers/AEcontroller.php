<?php

namespace App\Http\Controllers;

use App\Models\Product; 

class AEcontroller extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('AE.index', compact('products'));
    }

    public function showProduct($id)
    {
        $products = Product::all();
        $product = Product::findOrFail($id);
        return view('AE.product', [
            'product'  => $product,
            'products' => $products
        ]);
    }

    //public function viewCart()//

    //public function addCart()//

    //public function removeFromeCart()//

    //public function placeOrder()//

    //public function checkOut()//


}
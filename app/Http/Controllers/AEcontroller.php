<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $comments = Comment::where('product_id', $id)
            ->select('comment', 'review')
            ->get();
        $comments = $comments->isEmpty() ? null : $comments;
        return view('AE.product', [
            'product'  => $product,
            'products' => $products,
            'comments' => $comments
        ]);
    }

    
    public function commentStore(Request $request, $id)
    {
    $product = \App\Models\Product::find($id);
    $validated = $request->validate([
        'review' => 'required|integer|min:0|max:5',
        'comment' => 'required|string|max:1000',
    ]);
    \App\Models\Comment::create([
        'product_id' => $product->id,
        'user_id' => Auth::id(), 
        'review' => $validated['review'],
        'comment' => $validated['comment'],
    ]);
    return $this->showProduct($id);
    }
}

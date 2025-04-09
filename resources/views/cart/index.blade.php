@extends('AE.layouts')

@section('title', 'cart')
@section('description', 'cart')
@section('name', 'ANAHEIM ELECTRONICS cart')
@section('index.css')
<link href="{{ asset('cart.index.css') }}" rel="stylesheet">
@endsection

@section('maincontent')
<div class="Message">
    @if(session('success'))
        <p style="display: inline;">{{ session('success') }}</p><br>
        <a href="/AE" class="btn btn-primary">買い物を続ける！<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            
        </body>
        </html></a>
    @endif
    <form id="settlement" action="{{ route('checkout') }}" method="POST">
    @csrf
    <input type="hidden" name="total_price" value="{{ $TotalPrice }}">
    <button type="submit" class="purchase-btn">購入手続きへ</button>
    </form>
</div>

<h1 class="currentCart">現在のカート</h1>

    @foreach ($cartItems as $item)
    <div class="cart-container">
        <div class="cart-item">
            <img src="{{ asset('storage/photos/' .  $item->product->img_path) }}" alt="{{ $item->product->name }}">
            <h2>{{ $item->product->name }}</h2>
            <p>価格: {{ $item->product->price }}円</p>
            <p>数量: {{ $item->quantity }}</p>
            <p>小計: {{ $item->product->price * $item->quantity }}円</p>
        </div>
        <div class="button-area">
            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </div>
    </div>
    @endforeach

<h2 class="TotalPrice">合計金額: ${{ number_format($TotalPrice) }}</h2>

@endsection

@extends('AElayouts')

@section('title', 'Product')
@section('description', 'MS productPage')
@section('name', 'ANAHEIM ELECTRONICS')

@section('maincontent')
<h1>現在のカート</h1>
<div class="cart-container">
    @foreach ($cartItems as $item)
        <div class="cart-item">
            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}">
            <h2>{{ $item->product->name }}</h2>
            <p>価格: {{ $item->product->price }}円</p>
            <p>数量: {{ $item->quantity }}</p>
            <p>小計: {{ $item->product->price * $item->quantity }}円</p>
        </div>
    @endforeach
</div>
<h1>合計金額: {{ $TotalPrice }}円</h1>
<form action="{{ route('checkout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">購入手続きに進む</button>
</form>
@endsection

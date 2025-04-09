@extends('AE.layouts')

@section('title', 'Product')
@section('description', 'MS productPage')
@section('name', 'ANAHEIM ELECTRONICS')
@section('index.css')
<link href="{{ asset('product.css') }}" rel="stylesheet">
@endsection

@section('maincontent')
<div class="product_main">
    <div class="mobilesuit">
        <img src="{{ asset('storage/photos/' . $product->img_path) }}" alt="{{ $product->name }}">
        <p>{{ $product->name }}</p>
        <p>$ {{ $product->price }}</p>
    </div>
    <article>
        <p>{{ $product->description }}</P>
    </article>
</div>
{{-- 以下、個数選択と購入ボタンコード --}}
<section class="button">
<form action="{{ route('cart.store') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <label for="quantity">Quantity:</label>
        <select id="quantity" name="quantity">
            @for ($i = 1; $i <= 10; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <button type="submit">Add to Cart</button>
    </form>
</section>
@endsection

@section('subcontent')
<ul class="MSlist">
    @foreach ($products as $product)
    <li>
        <img src="{{ asset('storage/photos/' . $product->img_path) }}" alt="{{ $product->name }}">
        <p><a href="/AE/product/{{ $product->id }}">{{ $product->name }}</a></p>
        <p>Price:$ {{ $product->price }}</p>
    </li>
    @endforeach
</ul>
@endsection
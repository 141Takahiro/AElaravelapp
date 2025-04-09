@extends('AE.layouts')

@section('title', 'Index')
@section('description', 'MS salePage')
@section('name', 'ANAHEIM ELECTRONICS')
@section('index.css')
<link href="{{ asset('index.css') }}" rel="stylesheet">
@endsection

@section('maincontent')
<ul class="MSlist">
@foreach ($products as $product)
    <li>
        <img src="storage/photos/{{ $product->img_path }}" alt="{{ $product->name }}">
        <p><a href="/AE/product/{{ $product->id }}">{{ $product->name }}</a></p>
        <p>Price: ${{ $product->price }}</p>
    </li>
@endforeach
</ul>
@endsection
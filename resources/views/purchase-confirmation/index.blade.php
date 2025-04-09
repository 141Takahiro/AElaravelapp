@extends('AE.layouts')

@section('title', 'purchase-confirmation')
@section('description', 'purchase-confirmation')
@section('name', 'ANAHEIM ELECTRONICS purchase-confirmation')
@section('index.css')
<link href="{{ asset('purchase-confirmation.css') }}" rel="stylesheet">
@endsection

@section('maincontent')
<h2 class="thanks">購入ありがとうございました！</h2>
<div class="container">
    <div class="character">
            <img src="{{ asset('storage/photos/' . $character->img_path) }}" alt="{{ $character->name }}">
            <p>{{ $character->name }}</p>
    </div>
    <p id="comment">「{{ $character->comment }}」</p>
<div>
    @endsection

@section('subcontent')
<form action="/AE" method="GET">
    @csrf
    <button type="submit" class="btn btn-primary">TOPページに戻る</button>
</form>
@endsection
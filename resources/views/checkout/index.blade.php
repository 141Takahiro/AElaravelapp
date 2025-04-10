@extends('AE.layouts')

@section('title', 'CheckOut')
@section('description', 'MS CheckOutPage')
@section('name', 'ANAHEIM ELECTRONICS')
@section('index.css')
<link href="{{ asset('checkout.css') }}" rel="stylesheet">
@endsection

@section('maincontent')
<h1>購入手続き</h1>
<table>
    <thead>
        <tr>
            <th>商品名</th>
            <th>価格（円）</th>
            <th>数量</th>
            <th>小計（円）</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $cartItem)
            <tr>
                <td>{{ $cartItem->product->name }}</td>
                <td>{{ number_format($cartItem->product->price) }}</td>
                <td>{{ $cartItem->quantity }}</td>
                <td>{{ number_format($cartItem->product->price * $cartItem->quantity) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<h2>合計金額: {{ number_format($TotalPrice) }}円</h2>
<h3>購入者氏名: {{ auth()->user()->name }}</h3>
<h3>配送先： {{ auth()->user()->address }}</h3>

<button id="changeAddressButton">住所を変更する</button>
<div id="addressForm" style="display: none;">
    <form action="/update-address" method="POST">
        @csrf
        <label for="address">新しい住所:</label>
        <input type="text" name="address" id="address" required>
        <button type="submit">更新</button>
    </form>
</div>

<script>
    document.getElementById('changeAddressButton').addEventListener('click', function() {
        const form = document.getElementById('addressForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });
</script>


<div class="button">
    <button type="button" class="btn btn-primary" onclick="confirmPurchase()">購入</button>
</div>

<script>
function confirmPurchase() {
    const userConfirmed = confirm("確定しますか？");
    if (userConfirmed) {
        const totalPrice = @json($TotalPrice);
        const url = `{{ route('purchase-confirmation') }}?totalPrice=${totalPrice}`;
        window.location.href = url;
    } else {
        console.log("購入手続きがキャンセルされました。");
    }
}
</script>

@endsection

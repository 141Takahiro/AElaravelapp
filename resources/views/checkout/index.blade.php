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
<h3>郵便番号: {{ auth()->user()->zipcode }}</h3>
<h3>配送先： {{ auth()->user()->address }}</h3>

<button id="changeAddressButton">住所を変更する</button>
<div id="addressForm" style="display: none;">
    <form action="/update-address" method="POST">
        @csrf
        <label for="zipcode">新しい郵便番号:</label>
        <input type="text" name="zipcode" id="zipcode" required maxlength="8">
        <label for="address">新しい住所:</label>
        <input type="text" name="address" id="address" required style="width: 400px;">
        <button type="submit" style="background-color: red; color: white;">更新</button>
    </form>
</div>

<script>
    document.getElementById('changeAddressButton').addEventListener('click', function() {
        const form = document.getElementById('addressForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const zipcodeInput = document.getElementById('zipcode');
    
    zipcodeInput.addEventListener('input', function () {
        const zipcode = this.value.replace('-', '');
        if (zipcode.length === 7) {
            fetch(`https://zipcloud.ibsnet.co.jp/api/search?zipcode=${zipcode}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('通信に失敗しました。');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.results) {
                        const addressData = data.results[0];
                        const fullAddress = `${addressData.address1}${addressData.address2}${addressData.address3}`;
                        const addressField = document.getElementById('address');
                        if (addressField) {
                            addressField.value = fullAddress;
                        }
                    } else {
                        alert('該当する住所が見つかりませんでした。');
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert('通信に失敗しました。もう一度お試しください。');
                });
        }
    }); 
});
</script>


<div class="button">
    <button type="button" class="btn btn-primary" style="margin: 30px;" onclick="confirmPurchase()">購入</button>
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

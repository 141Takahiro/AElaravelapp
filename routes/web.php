<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AEcontroller;
use Illuminate\Auth\Middleware\Authenticate;//認証画面作成のために追加//
use App\Http\Controllers\CartController;//cart機能実装のため作成
use App\Http\Controllers\CheckoutController;//決済確認画面
use App\Http\Controllers\PurchaseController;//購入確認画面

//ここからログイン画面作成のための記述
Route::post('/logout', function () {
    Auth::logout();
});
Route::get('/', function () {
        return view('auth.login');
    });
//ここまでログイン画面作成のため

Route::get('AE', [AEcontroller::class, 'index'])
   ->middleware('auth');//認証画面作成のために追加//

Route::get('AE/product/{id}', [AEcontroller::class, 'showProduct']);
Route::post('AE/product/{id}/comment/store', [AEcontroller::class, 'commentStore'])->name('comment.store');
Auth::routes();

Route::post('/cart', [CartController::class, 'store'])->name('cart.store');//cartに追加
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');//cartのview表示
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');//delete用

Route::post('/chekout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/chekout', [CheckoutController::class, 'checkout']);
Route::post('/update-address', [CheckoutController::class, 'updateAddress'])->name('update.address');
Route::get('/purchase-confirmation', [PurchaseController::class, 'confirmation'])->name('purchase-confirmation');

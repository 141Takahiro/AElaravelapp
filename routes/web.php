<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AEcontroller;
use Illuminate\Auth\Middleware\Authenticate;//認証画面作成のために追加//
use App\Http\Controllers\CartController;//cart機能実装のため作成
use App\Http\Controllers\CheckoutController;//決済確認画面
use App\Http\Controllers\PurchaseController;//購入確認画面


Route::get('AE', [AEcontroller::class, 'index'])
    ->middleware('auth');//認証画面作成のために追加//

Route::get('AE/product/{id}', [AEcontroller::class, 'showProduct']);
Auth::routes();

Route::post('/cart', [CartController::class, 'store'])->name('cart.store');//cartに追加
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');//cartのview表示
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');//delete用

Route::post('/chekout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/purchase-confirmation', [PurchaseController::class, 'confirmation'])->name('purchase-confirmation');

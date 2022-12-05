<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::resource('product', ProductController::class)->except(['create','store','edit','update','destroy']);
    Route::get('transaction/cart', [TransactionController::class, 'index'])->name('cart');
    Route::post('transaction/add-product', [TransactionController::class, 'add_product'])->name('add_product');
    Route::post('transaction/checkout', [TransactionController::class, 'checkout'])->name('checkout');
    Route::get('transaction/print', [TransactionController::class, 'print'])->name('print');

});

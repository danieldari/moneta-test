<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Payment');
});
Route::post('/payment-submit', [PaymentController::class, 'initiatPayment'])->name('payment.submit');
Route::post('/payment-verify/{reference}', [PaymentController::class, 'verifyPayment'])->name('payment.verify');

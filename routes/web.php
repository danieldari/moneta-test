<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Payment');
});
Route::get('/notify', function () {
    return view('Notification');
});

Route::post('/payment-submit', [PaymentController::class, 'initiatPayment'])->name('payment.submit');
Route::post('/payment-verify/{reference}', [PaymentController::class, 'verifyPayment'])->name('payment.verify');

Route::post('/notification-send', [NotificationController::class, 'send'])->name('notification.send');

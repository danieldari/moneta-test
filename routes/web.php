<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Payment');
});
Route::get('/notify', function () {
    return view('Notification');
});
Route::get('/utility', function () {
    return view('utility');
});
Route::get('/bvn', function () {
    return view('bvn');
});

Route::post('/payment-submit', [PaymentController::class, 'initiatPayment'])->name('payment.submit');
Route::post('/payment-verify/{reference}', [PaymentController::class, 'verifyPayment'])->name('payment.verify');

Route::post('/notification-send', [NotificationController::class, 'send'])->name('notification.send');

Route::post('/utility-pay', [UtilityController::class, 'pay'])->name('utility.pay');
Route::get('/test_function', [NotificationController::class, 'test_function'])->name('utility.pay');

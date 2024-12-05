<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FinanceController;


// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';


Route::get('/home', 'App\Http\Controllers\StripeController@index')->name('index');
Route::post('checkout', 'App\Http\Controllers\StripeController@checkout')->name('checkout');
Route::get('success', 'App\Http\Controllers\StripeController@success')->name('success');


Route::get('finance', [FinanceController::class, 'financePayment'])->name('finance');
Route::post('/create-payment', [FinanceController::class, 'createPaymentRequest'])->name('create.payment');
Route::post('/webhook/request-finance', [FinanceController::class, 'handleWebhook']);

Route::get('/', 'App\Http\Controllers\StripeController@home')->name('home');
Route::post('/customer-event', 'App\Http\Controllers\StripeController@customerEvent')->name('customer.event');

Route::get('error', function(){
    return view('error');
})->name('error');



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('dashboard', [AdminController::class, 'AdminDashboard'])->name('dashboard');

});



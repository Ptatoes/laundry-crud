<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CustomerController;





Route::get('/', function () {
    return view('home'); // Points to the home.blade.php view
})->name('home'); // Assigns the name 'home' to this route

// // web.php
// Route::post('/customers/store', [CustomerController::class, 'store'])->name('customers.store');

 Route::resource('customers', CustomerController::class);
Route::resource('orders', OrderController::class);
Route::resource('services', ServiceController::class);




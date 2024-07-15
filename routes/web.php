<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

// Route::get('/prd', function () {
//     return view('emails.payment_confirmation');
// });

// Route::get('/masterLayout', function () {
//     return view('layouts.master');
// })->name('masterLayout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/products/{id}/buy', [PaymentController::class, 'checkout'])->name('products.buy');
Route::post('/products/{id}/process', [PaymentController::class, 'process'])->name('products.process');
Route::get('/thankYou', [PaymentController::class, 'thankYou'])->name('thankYou');



Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('products', ProductController::class);
});

Route::middleware('web')->group(function () {
    Route::get('/', [PagesController::class, 'home'])->name('home');
    Route::get('/{id}', [PagesController::class, 'productDetails'])->name('productDetails');
});





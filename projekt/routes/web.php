<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ShoeController::class, 'index'])->name('shoes.index');
Route::get('/shoes/{shoe}', [ShoeController::class, 'show'])->name('shoes.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{shoe}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{shoe}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{shoe}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/dashboard', function () {
    return redirect()->route('shoes.index');
})->name('dashboard');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.my');


Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/shoes', [ShoeController::class, 'adminIndex'])->name('shoes.index');
    Route::get('/shoes/create', [ShoeController::class, 'create'])->name('shoes.create');
    Route::post('/shoes', [ShoeController::class, 'store'])->name('shoes.store');
    Route::get('/shoes/{shoe}/edit', [ShoeController::class, 'edit'])->name('shoes.edit');
    Route::put('/shoes/{shoe}', [ShoeController::class, 'update'])->name('shoes.update');
    Route::delete('/shoes/{shoe}', [ShoeController::class, 'destroy'])->name('shoes.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.my');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/shoes/{shoe}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});


require __DIR__.'/auth.php';

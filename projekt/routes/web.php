<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

// Strona główna sklepu
Route::get('/', [ShoeController::class, 'index'])->name('shoes.index');

// Widok pojedynczego buta
Route::get('/shoes/{shoe}', [ShoeController::class, 'show'])->name('shoes.widok');

// Trasy dla koszyka

Route::get('/', [ShoeController::class, 'index'])->name('shoes.index'); //
Route::get('/shoes/{shoe}', [ShoeController::class, 'show'])->name('shoes.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Wyświetlanie zawartości koszyka
Route::post('/cart/add/{shoe}', [CartController::class, 'add'])->name('cart.add'); // Dodawanie buta do koszyka
Route::post('/cart/update/{shoe}', [CartController::class, 'update'])->name('cart.update'); // Aktualizacja ilości butów w koszyku
Route::post('/cart/remove/{shoe}', [CartController::class, 'remove'])->name('cart.remove'); // Usuwanie buta z koszyka
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear'); // Czyszczenie całego koszyka

Route::get('/dashboard', function () {
    return redirect()->route('shoes.index'); // Przekierowanie na stronę główną sklepu
})->name('dashboard');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index'); // Wyświetlanie strony realizacji zamówienia
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store'); // Przetwarzanie zamówienia
Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.my'); // Wyświetlanie zamówień użytkownika


Route::middleware(['auth', 'validate'])->group(function () {
    Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.index'); // Wyświetlanie zamówień użytkownika
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Edycja profilu
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Aktualizacja profilu
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Usuwanie konta
});

require __DIR__.'/auth.php'; // Trasy związane z autoryzacją (rejestracja, logowanie, itp.)
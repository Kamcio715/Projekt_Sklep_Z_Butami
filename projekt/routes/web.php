<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;

// Strona główna
Route::get('/', [ShoeController::class, 'index'])->name('shoes.index');
// Strona szczegółów produktu
Route::get('/shoes/{shoe}', [ShoeController::class, 'show'])->name('shoes.show');

// Koszyk
Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // Strona koszyka
Route::post('/cart/add/{shoe}', [CartController::class, 'add'])->name('cart.add'); // Dodawanie produktu do koszyka
Route::post('/cart/update/{cartKey}', [CartController::class, 'update'])->name('cart.update'); // Aktualizacja ilości produktu w koszyku
Route::post('/cart/remove/{cartKey}', [CartController::class, 'remove'])->name('cart.remove'); // Usuwanie produktu z koszyka
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear'); // Czyszczenie koszyka

// Powrot do strny głównej
Route::get('/dashboard', function () {
    return redirect()->route('shoes.index');
})->name('dashboard');

// Strony związane z zamówieniami i profilem
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index'); // Strona realizacji zamówienia
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store'); // Przetwarzanie zamówienia
Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.my'); // Strona z zamówieniami użytkownika

// Strony związane z profilem użytkownika
Route::prefix('admin')->name('admin.')->middleware(['auth', 'is_admin'])->group(function () { // Grupa tras dla administratora
    Route::get('/shoes', [ShoeController::class, 'adminIndex'])->name('shoes.index'); // Strona zarządzania butami dla administratora
    Route::get('/shoes/create', [ShoeController::class, 'create'])->name('shoes.create'); // Strona tworzenia nowego buta
    Route::post('/shoes', [ShoeController::class, 'store'])->name('shoes.store'); // Przetwarzanie tworzenia nowego buta
    Route::get('/shoes/{shoe}/edit', [ShoeController::class, 'edit'])->name('shoes.edit'); // Strona edycji buta
    Route::put('/shoes/{shoe}', [ShoeController::class, 'update'])->name('shoes.update'); // Przetwarzanie aktualizacji buta
    Route::delete('/shoes/{shoe}', [ShoeController::class, 'destroy'])->name('shoes.destroy'); // Przetwarzanie usuwania buta
});

Route::middleware(['auth', 'verified'])->group(function () { // Grupa tras dla zalogowanych i zweryfikowanych użytkowników
    Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.my'); // Strona z zamówieniami użytkownika
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Strona edycji profilu
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Przetwarzanie aktualizacji profilu
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Przetwarzanie usuwania konta
});

Route::middleware('auth')->group(function () { // Grupa tras dla zalogowanych użytkowników (recenzje)
    Route::post('/shoes/{shoe}/reviews', [ReviewController::class, 'store'])->name('reviews.store'); // Dodawanie recenzji
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit'); // Strona edycji recenzji
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update'); // Przetwarzanie aktualizacji recenzji
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy'); // Przetwarzanie usuwania recenzji
});


require __DIR__.'/auth.php'; 

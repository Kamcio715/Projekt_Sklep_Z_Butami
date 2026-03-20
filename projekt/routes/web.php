<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Strona główna sklepu
Route::get('/', [ShoeController::class, 'index'])->name('shoes.index');

// Widok pojedynczego buta
Route::get('/buty/{but}', [ShoeController::class, 'show'])->name('buty.widok');

// Trasy dla koszyka
Route::get('/koszyk', [CartController::class, 'index'])->name('koszyk.index'); // Wyświetlanie zawartości koszyka
Route::post('/koszyk/dodaj/{but}', [CartController::class, 'add'])->name('koszyk.dodaj'); // Dodawanie produktu do koszyka
Route::post('/koszyk/aktualizuj/{but}', [CartController::class  ,'update'])->name('koszyk.aktualizuj'); // Aktualizowanie ilości produktów w koszyku
Route::post('/koszyk/usun/{but}', [CartController::class, 'remove'])->name('koszyk.usun'); // Usuwanie produktu z koszyka
Route::post('/koszyk/wyczysc', [CartController::class, 'clear'])->name('koszyk.wyczysc'); // Czyszczenie całego koszyka

// Przeniesienie do strony głównej po zalogowaniu
Route::get('/dashboard', function(){
    return redirect()->route('buty.index');
})->name('dashboard');

Route::get('/podsumowanie', [CheckoutController::class, 'index'])->name('checkout.index'); // Wyświetlanie podsumowania zamówienia
Route::post('/podsumowanie', [CheckoutController::class, 'store'])->name('checkout.store'); // Przetwarzanie zamówienia
Route::get('/moje-zamowienia', [CheckoutController::class, 'mojeZamowienia'])->name('orders.index'); // Wyświetlanie zamówień użytkownika
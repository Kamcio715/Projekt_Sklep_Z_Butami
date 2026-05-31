<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
 
// Autoryzacja gości (niezalogowanych użytkowników)
Route::middleware('guest')->group(function () { 
    Route::get('register', [RegisteredUserController::class, 'create']) // Rejestracja
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']); // Zapisywanie nowego użytkownika do bazy danych

    Route::get('login', [AuthenticatedSessionController::class, 'create']) // Logowanie
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']); // Przetwarzanie danych logowania i tworzenie sesji użytkownika

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create']) // Formularz do wprowadzenia adresu e-mail w celu resetowania hasła
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store']) // Przetwarzanie żądania resetowania hasła i wysyłanie e-maila z linkiem do resetowania
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create']) // Formularz do wprowadzenia nowego hasła po kliknięciu w link z e-maila
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store']) // Przetwarzanie nowego hasła i aktualizacja go w bazie danych
        ->name('password.store');
});
// Autoryzacja dla zalogowanych użytkowników
Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class) // Wyświetlanie prośby o weryfikację adresu e-mail
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class) // Weryfikacja adresu e-mail po kliknięciu w link z e-maila
        ->middleware(['signed', 'throttle:6,1']) // Ograniczenie liczby prób weryfikacji do 6 na minutę
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store']) // Wysyłanie ponownego e-maila z linkiem do weryfikacji
        ->middleware('throttle:6,1') // Ograniczenie liczby prób wysyłania e-maili do 6 na minutę
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show']) // Formularz do potwierdzenia hasła przed wykonaniem wrażliwych operacji (np. zmiana adresu e-mail, usuwanie konta)
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']); // Przetwarzanie potwierdzenia hasła

    Route::put('password', [PasswordController::class, 'update']) // Aktualizacja hasła dla zalogowanego użytkownika
        ->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']) // Wylogowywanie użytkownika i niszczenie sesji
        ->name('logout');
});
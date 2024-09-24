<?php


use Elcomware\LocaleMaster\Http\LocaleController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::resource('locales', LocaleController::class);
    Route::get('switch-locale/{locale}', [LocaleController::class, 'switchLocale'])->name('locales.switch');
});

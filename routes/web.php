<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\PasteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/paste/{hash}', [PasteController::class, 'showPaste'])->name('paste');
Route::post('/', [PasteController::class, 'createPaste'])->name('home');
Route::get('/last-pastes', [PasteController::class, 'lastPastes'])->name('last-pastes');
Route::middleware('guest')->group(function(){
    Route::get('/register', [UserController::class, 'register'])->name('auth.register');
    Route::post('/register', [UserController::class, 'registration'])->name('auth.register');
    Route::get('/login', [UserController::class, 'login'])->name('auth.login');
    Route::post('/login', [UserController::class, 'auth'])->name('auth.login');
});
Route::middleware('auth')->group(function(){
    Route::get('/my-pastes/{page?}', [PasteController::class, 'myPastes'])->name('my-pastes');
    Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');
    Route::get('/my-last-pastes', [PasteController::class, 'myLastPastes'])->name('my-last-pastes');
});

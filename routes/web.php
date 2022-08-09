<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/paste/{hash}', [MainController::class, 'showPaste'])->name('paste');
Route::post('/', [MainController::class, 'createPaste'])->name('home');
Route::get('/last-pastes', [MainController::class, 'lastPastes'])->name('last-pastes');
Route::middleware('guest')->group(function(){
    Route::get('/register', [MainController::class, 'register'])->name('auth.register');
    Route::post('/register', [MainController::class, 'registration'])->name('auth.register');
    Route::get('/login', [MainController::class, 'login'])->name('auth.login');
    Route::post('/login', [MainController::class, 'auth'])->name('auth.login');
});
Route::middleware('auth')->group(function(){
    Route::get('/my-pastes/{page?}', [MainController::class, 'myPastes'])->name('my-pastes');
    Route::get('/logout', [MainController::class, 'logout'])->name('auth.logout');
    Route::get('/my-last-pastes', [MainController::class, 'myLastPastes'])->name('my-last-pastes');
});

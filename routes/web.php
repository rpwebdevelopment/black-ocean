<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\GameController;
use App\Http\Middleware\Authenticate;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/friends', function () {
        return view('friends');
    })->name('friends');

    Route::get('/ship', function () {
        return view('ship');
    })->name('ship');

    Route::get('/games', [GameController::class, 'index'])
        ->name('games');

    Route::get('/games/{id}', [GameController::class, 'show'])
        ->middleware(['game.auth'])
        ->name('game');

    Route::get('/character/{id}', [CharacterController::class, 'show'])
        ->name('character');
});

require __DIR__.'/auth.php';

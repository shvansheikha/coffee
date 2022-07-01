<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/authenticated', function () {
        return true;
    });

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Cards Routes
    Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
    Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
    Route::delete('/cards/{card}', [CardController::class, 'destroy'])->name('cards.destroy');

    // Baskets Routes
    Route::get('/baskets', [BasketController::class, 'index'])->name('baskets.index');

    // Groups Routes
    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');

    // Products Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    // Games Routes
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
});

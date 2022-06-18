<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    //Cards Routes
    Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
    Route::post('/cards', [CardController::class, 'store'])->name('cards.create');
    Route::get('/cards/destroy/{card}', [CardController::class, 'destroy'])->name('cards.destroy');
    Route::put('/cards/update/{card}', [CardController::class, 'update'])->name('cards.update');
    Route::get('/cards/edite/{card}', [CardController::class, 'edite'])->name('cards.edite');

    //Orders Routes
    Route::get('cards/{card}/orders', [OrderController::class, 'show'])->name('orders.index');
    Route::post('cards/{card}/orders', [OrderController::class, 'store'])->name('orders.create');
    Route::post('cards/{card}/orders-game', [OrderController::class, 'game'])->name('orders.game');
    Route::get('cards/{card}/{order}/stop', [OrderController::class, 'stop'])->name('orders.stop');
    Route::get('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    //Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.create');
    Route::get('/products/destroy/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/edite/{product}', [ProductController::class, 'edite'])->name('products.edite');

    //Games Routes
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::post('/games', [GameController::class, 'store'])->name('games.create');
    Route::get('/games/destroy/{game}', [GameController::class, 'destroy'])->name('games.destroy');
});

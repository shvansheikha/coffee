<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    //Cards Routes
    Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
    Route::post('/cards', [CardController::class, 'store'])->name('cards.create');
    Route::get('/cards/destroy/{card}', [CardController::class, 'destroy'])->name('cards.destroy');
    Route::put('/cards/update/{card}', [CardController::class, 'update'])->name('cards.update');
    Route::get('/cards/edite/{card}', [CardController::class, 'edite'])->name('cards.edite');

    //Basket Routes
    Route::put('{card}/update/{basket}', [BasketController::class, 'update'])->name('baskets.update');
    Route::get('/baskets/{date}', [BasketController::class, 'index'])->name('baskets.index');
    Route::get('/baskets/{basket}/orders', [BasketController::class, 'show'])->name('baskets.show');
    Route::get('/baskets/{basket}/print', [BasketController::class, 'printing'])->name('baskets.print');

    //Groups Routes
    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.create');
    Route::get('/groups/{group}/destroy', [GroupController::class, 'destroy'])->name('groups.destroy');
    Route::get('/groups/{group}/edite', [GroupController::class, 'edite'])->name('groups.edite');
    Route::put('/groups/{group}/update', [GroupController::class, 'update'])->name('groups.update');

    //Orders Routes
    Route::get('cards/{card}/orders', [OrderController::class, 'show'])->name('orders.index');
    Route::post('cards/{card}/orders', [OrderController::class, 'store'])->name('orders.create');
    Route::post('cards/{card}/orders-game', [OrderController::class, 'game'])->name('orders.game');
    Route::get('cards/{card}/{order}/stop', [OrderController::class, 'stop'])->name('orders.stop');
    Route::get('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    Route::post('api/fetch-products', [OrderController::class, 'fetchProducts']);
    Route::post('api/fetch-games', [OrderController::class, 'fetchGames']);

    //Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'store'])->name('products.create');
    Route::get('/products/{product}/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::get('/products/{product}/edite', [ProductController::class, 'edite'])->name('products.edite');

    //Games Routes
    Route::get('/games', [GameController::class, 'index'])->name('games.index');
    Route::post('/games', [GameController::class, 'store'])->name('games.create');
    Route::get('/games/{game}/destroy', [GameController::class, 'destroy'])->name('games.destroy');
    Route::put('/games/{game}/update', [GameController::class, 'update'])->name('games.update');
    Route::get('/games/{game}/edite', [GameController::class, 'edite'])->name('games.edite');
});

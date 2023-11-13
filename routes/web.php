<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\StopGameController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('register', [RegisterController::class, 'registerForm']);
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'loginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::get('logout', [LoginController::class, 'logout']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::put('/user', [UserController::class, 'update'])->name('user.update');

    Route::get('/authenticated', function () {
        return true;
    });

    Route::get('/reports', [HomeController::class, 'report'])->name('reports');

    // Cards Routes
    Route::get('/cards', [CardController::class, 'index'])->name('cards.index');
    Route::post('/cards', [CardController::class, 'store'])->name('cards.store');
    Route::put('/cards/{card}', [CardController::class, 'update'])->name('cards.update');
    Route::delete('/cards/{card}', [CardController::class, 'destroy'])->name('cards.destroy');

    // Baskets Routes
    Route::get('/baskets', [BasketController::class, 'index'])->name('baskets.index');
    Route::get('/baskets/{basket}', [BasketController::class, 'show'])->name('baskets.show');
    Route::put('/baskets/{basket}', [BasketController::class, 'update'])->name('baskets.update');

    // Orders Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{basket}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/{basket}/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/stop-game/{order}', StopGameController::class)->name('orders.stop');
    Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

    // Groups Routes
    Route::get('/api/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups', [GroupController::class, 'show'])->name('groups.show');
    Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
    Route::put('/groups/{group}', [GroupController::class, 'update'])->name('groups.update');
    Route::delete('/groups/{group}', [GroupController::class, 'destroy'])->name('groups.destroy');

    // Products Routes
    Route::get('/api/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products', [ProductController::class, 'show'])->name('products.show');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Games Routes
    Route::get('/api/games', [GameController::class, 'index'])->name('games.index');
    Route::get('/games', [GameController::class, 'show'])->name('games.show');
    Route::post('/games', [GameController::class, 'store'])->name('games.store');
    Route::put('/games/{game}', [GameController::class, 'update'])->name('games.update');
    Route::put('/start-game/{game}', [GameController::class, 'startGame'])->name('games.start');
    Route::put('/stop-game/{game}/{basket}', [GameController::class, 'stopGame'])->name('games.stop');
    Route::delete('/games/{game}', [GameController::class, 'destroy'])->name('games.destroy');
});

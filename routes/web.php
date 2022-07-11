<?php

use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;


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

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/cart', [HomeController::class, 'cart'])->name('cart');

Route::get('/checkout', [HomeController::class, 'checkout'])->name('checkout');

Route::get('/menus/{menu}',[MenuController::class, 'show'])->name('menus.show');


Route::get('cart', [CardController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [CardController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [CardController::class, 'update'])->name('update.cart');
Route::patch('increment-cart', [CardController::class, 'increment'])->name('increment.cart');
Route::delete('remove-from-cart', [CardController::class, 'remove'])->name('remove.from.cart');

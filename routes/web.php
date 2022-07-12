<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
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

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::resource('menu', MenuController::class);


Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('update', [CartController::class, 'update'])->name('cart.update');
Route::delete('destroy', [CartController::class, 'destroy'])->name('cart.destroy');

Route::get('checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::get('thank-you', [OrderController::class, 'success'])->name('order.success');

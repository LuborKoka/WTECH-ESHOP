<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::post('/add', 'App\Http\Controllers\BookController@store')->name('book.store');


Route::get('/', 'App\Http\Controllers\BookController@showAll')->name('home');

Route::get('/genre', 'App\Http\Controllers\BookController@showGenreBooks')->name('genre');

Route::get('/book', 'App\Http\Controllers\BookController@show')->name('book');




Route::get('/add', function () {
    return view('admin.add');
})->name('add');


Route::get('/cart', 'App\Http\Controllers\ShoppingCartController@show')->name('shopping-cart');
Route::post('/cart/add_item', 'App\Http\Controllers\ShoppingCartController@addItem')->name('cart.add_item');

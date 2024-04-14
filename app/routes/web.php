<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


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

Route::get('/', 'App\Http\Controllers\BookController@showAll')->name('home');

Route::get('/genre', 'App\Http\Controllers\BookController@showGenreBooks')->name('genre');

Route::get('/book', 'App\Http\Controllers\BookController@show')->name('book');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Genre;
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

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/add', 'AdminController@index')->name('admin.add');
    Route::post('/add', 'App\Http\Controllers\BookController@store')->name('book.store');
    Route::get('/edit', 'App\Http\Controllers\BookController@showAllAdmin')->name('edit');
    Route::get('edit_book', 'App\Http\Controllers\BookController@showAdmin')->name('edit_book');
    Route::put('/edit_book', 'App\Http\Controllers\BookController@update')->name('book.update');
    Route::delete('/edit_book', 'App\Http\Controllers\BookController@destroy')->name('book.delete');
    
    Route::get('/add', function () {
        $genres = Genre::all();
        return view('admin.add', compact('genres'));
    })->name('add');
});



Route::get('/', 'App\Http\Controllers\BookController@showAll')->name('home');

Route::get('/genre', 'App\Http\Controllers\BookController@showGenreBooks')->name('genre');

Route::get('/book', 'App\Http\Controllers\BookController@show')->name('book');


Route::get('/admin_login', function () {
    return view('admin.admin_login');
})->name('admin_login');


Route::get('/cart', 'App\Http\Controllers\ShoppingCartController@show')->name('shopping-cart');
Route::post('/cart/item', 'App\Http\Controllers\ShoppingCartController@addItem')->name('cart.add_item');
Route::patch('/cart/item', 'App\Http\Controllers\ShoppingCartController@updateItem')->name('cart.update_item');
Route::delete('/cart/item', 'App\Http\Controllers\ShoppingCartController@deleteItem')->name('cart.delete_item');

Route::get('/payment', function() {return view('pages.payment');})->name('payment');
Route::post('/payment', 'App\Http\Controllers\OrderController@create')->name('payment.create');

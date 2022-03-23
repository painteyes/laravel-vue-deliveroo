<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

// Rotte per l'autenticazione (register, login, logout)
Auth::routes();

// Rotta per la homepage pubblica
Route::get('/', 'HomeController@home')->name('home');

// Rotte protette da autenticazione
Route::middleware('auth')  
	->namespace('Admin')
	->name('admin.')
	->prefix('admin')
	->group(function() {

	// Rotta per la pagina specifica del ristorante dopo l'accesso
<<<<<<< HEAD
	Route::get('/', 'Admin/HomeController@home')->name('home');


});


// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
=======
	Route::get('/', 'HomeController@home')->name('home');
	Route::get('/dishes/{id}', 'DishController@getRestaurantDishes');
});
>>>>>>> 8ccc65ad784c042eb880189a102cdcc9bc34f9c2

<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('auth')  // per privatizzare i controlli
	->namespace('Admin')
	->name('admin.')
	->prefix('admin')
	->group(function() {
	// qui metto tutte le rotte private
	Route::get('/', 'HomeController@index')->name('home');
});


Route::get("{any?}", function(){
    return view("guests.home");
})->where("any", ".*");

// Route::get('/home', 'HomeController@index')->name('home');

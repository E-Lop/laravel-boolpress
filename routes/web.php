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

// rotte admin di backend gestite da laravel
Route::middleware('auth')
->namespace('Admin')
->name('admin.')
->prefix('admin')
->group(function() {
	Route::get('/', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
});

// rotte guest
Route::get('{any?}', function () {
    return view('guest.home');
})->where("any", ".*");


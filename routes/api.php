<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API per tutti i post nel db
Route::get('/posts', 'Api\PostController@index');
// API per il dettaglio del singolo post
Route::get('/posts/{slug}', 'Api\PostController@show');
// API per i lead
Route::post('/leads', 'Api\LeadController@store');
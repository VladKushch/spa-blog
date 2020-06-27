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

// Auth
Route::namespace('Auth')->group(function () {
    Route::post('/login', 'AuthController@login');
    Route::post('/register', 'AuthController@register');

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', 'AuthController@logout');
        Route::post('/logged-in', 'AuthController@loggedIn');
    });
});

// Blog
Route::prefix('blog')->group(function () {
    Route::get('/all', 'PostsController@index');

    Route::middleware('auth:api')->group(function () {
        Route::post('/store', 'PostsController@store');
        Route::post('/update/{id}', 'PostsController@update');
        Route::post('/destroy/{id}', 'PostsController@destroy');
    });
});

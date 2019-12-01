<?php

use Illuminate\Http\Request;

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

Route::namespace('Api')->name('api.')->group(function () {

    Route::post('/register', 'RegisterController@register')->name('register');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout', 'LoginController@logout')->name('logout')->middleware('auth:api');

    Route::middleware('auth:api')->name('users.')->prefix('users')->group(function () {
        Route::get('/except-me', 'UserController@fetchUsersExceptMe')->name('except-me');
        Route::name('me')->get('/me', function (Request $request) {
            return $request->user();
        });
    });

    Route::middleware('auth:api')->name('messages.')->prefix('messages')->group(function () {
        Route::post('/send/users/{id}', 'MessageController@sendMessage')->name('send-to-user');
        Route::get('/received/users/{id}', 'MessageController@fetchMessagesByUser')->name('received-by-user');
    });
});

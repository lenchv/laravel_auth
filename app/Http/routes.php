<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource("users", "UserController");
Route::resource("books", "BookController");
Route::resource("userbooks", "UserBooksController");

Route::get("auth/github", "SocialAuthController@redirectToProvider");
Route::get("auth/github/callback", "SocialAuthController@handleProviderCallback");
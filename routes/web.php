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

Route::get('/','HomeController@index')->name('home');

/*authorization routs*/
Route::get('/signup','AuthController@getSignup')->name('auth.signup');
Route::post('/signup','AuthController@postSignup');

Route::get('/signin','AuthController@getSignin')->name('auth.signin');
Route::post('/signin','AuthController@postSignin');

// Route::get('/alert', function(){ return redirect()->route('home')->with('info','тест сообщения!');
// });

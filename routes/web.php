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
Route::get('/signup','AuthController@getSignup')
->middleware('guest')
->name('auth.signup');
Route::post('/signup','AuthController@postSignup')
->middleware('guest');

Route::get('/signin','AuthController@getSignin')
->middleware('guest')
->name('auth.signin');
Route::post('/signin','AuthController@postSignin')
->middleware('guest');

Route::get('/signout','AuthController@getSignout')
->name('auth.signout');

//Search routs
Route::get('/search','SearchController@getResults')
->name('search.results');



// Route::get('/alert', function(){ return redirect()->route('home')->with('info','тест сообщения!');
// });

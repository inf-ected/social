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

//Profile
Route::get('/user/{username}','ProfileController@getProfile')
->name('profile.index');

Route::get('/profile/edit/','ProfileController@getEdit')
->middleware('auth')
->name('profile.edit');

Route::post('/profile/edit','ProfileController@postEdit')
->middleware('auth');


//Friend
Route::get('/friends','FriendController@getIndex')
->middleware('auth')
->name('friend.index');

//my old version
// Route::get('/friends/deny/{id}','FriendController@DelRequest')
// ->middleware('auth')
// ->name('friend.delrequest');
// Route::get('/friends/accept/{id}','FriendController@AcceptRequest')
// ->middleware('auth')
// ->name('friend.acceptrequest');

Route::get('/friends/add/{username}','FriendController@getAdd')
->middleware('auth')
->name('friend.add');
Route::get('/friends/accept/{username}','FriendController@getAccept')
->middleware('auth')
->name('friend.accept');
Route::post('/friends/delete/{username}','FriendController@postDelete')
->middleware('auth')
->name('friend.delete');

#TimeLine - Стена!

Route::post('/status','StatusController@postStatus')
->middleware('auth')
->name('status.post');

Route::post('/status/{statusId}/reply','StatusController@postReply')
->middleware('auth')
->name('status.reply');

#Likes
Route::get('status/{statusId}/like', 'StatusController@getLike')
->middleware('auth')
->name('status.like');








//->name('profile.edit');
// Route::get('/alert', function(){ return redirect()->route('home')->with('info','тест сообщения!');
// });

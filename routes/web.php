<?php

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

Route::get('/', 'HomeController@index');

// Authentication routes
// Route::get('register', 'Auth\RegisterController@getRegister');
Route::post('store','Auth\RegisterController@storeUser');
Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('authenticate', 'Auth\LoginController@login');

Route::get('create', 'ItemController@create');
Route::get('docs', 'ItemController@getDocs');

//routes for voting likes and dislikes
Route::get('vote/like/{id}', 'ItemController@like')->middleware('auth');
Route::get('vote/dislike/{id}', 'ItemController@dislike')->middleware('auth');
Route::get('follow/{id}', 'ItemController@follow')->middleware('auth');
Route::get('unfollow/{id}', 'ItemController@unfollow')->middleware('auth');
Route::get('followers', 'ItemController@showFollowers')->middleware('auth');

Route::get('user/reviews/{id}', 'ItemController@showUserReviews');
Route::get('user/followers/{id}', 'ItemController@showUserFriends');

Route::group(['prefix' => 'item'], function() {

	Route::get('/{sku}', 'ItemController@showItem');
	Route::post('/add', 'ItemController@store');
	Route::get('edit/{sku}', 'ItemController@edit');
	Route::post('update', 'ItemController@update');
	Route::get('/delete/{sku}', 'ItemController@destroy');
	Route::get('image/{sku}', 'ItemController@addImage')->middleware('auth');
	Route::post('/addImage', 'ItemController@storeImage');

	//post review route
	Route::get('review/{sku}', 'ItemController@getReview')->middleware('auth');
	Route::post('review/store', 'ItemController@storeReview');

	Route::get('review/edit/{id}', 'ItemController@editReview');
	Route::post('review/update', 'ItemController@updateReview');
	Route::get('review/delete/{id}', 'ItemController@destroyReview');
});

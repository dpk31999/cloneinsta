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

Route::post('/p' ,'PostController@store');

Route::post('/img' ,'ProfileController@changeimage')->name('profile.image');

Route::get('/profile/{user}', 'ProfileController@index')->name('profile.show');
Route::get('/completeprofile', 'ProfileController@create');
Route::post('/profile','ProfileController@store')->name('profile.create');

Route::middleware(['checkprofile'])->group(function () {
    Route::get('accounts/edit', 'ProfileController@edit')->name('profile.edit');

    Route::get('accounts/password/change', 'ProfileController@changepass')->name('profile.editpass');
    Route::get('/p/create' ,'PostController@create')->name('posts.create');
    Route::get('/p/{post}', 'PostController@show')->name('posts.show');
    Route::get('/explore/people/suggested', 'ExploreController@show')->name('explore.show');
    Route::get('/', 'HoneController@index')->name('home');
});

Route::post('/accounts/{user}', 'ProfileController@update')->name('profile.update');\
Route::post('/accounts/password/{user}', 'ProfileController@updatepass')->name('profile.updatepass');
Route::post('/follow/{user}', 'FollowsController@store');
Route::post('/like/{user}/post/{post}', 'LikeController@store');
Route::post('/like/{user}/comment/{comment}', 'LikeController@storeLikeComment');
Route::post('/posts/{post}' ,'PostController@createcomment')->name('posts.comment');
Route::post('replyCmt/{comment}','PostController@createreplycomment')->name('posts.reply');

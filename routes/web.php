<?php
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
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
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
Route::get('/getId','HoneController@getId');

Route::post('/profile','ProfileController@store')->name('profile.create');

Route::middleware(['checkprofile'])->group(function () {
    Route::get('accounts/edit', 'ProfileController@edit')->name('profile.edit');

    Route::get('accounts/password/change', 'ProfileController@changepass')->name('profile.editpass');
    Route::get('/p/create' ,'PostController@create')->name('posts.create');
    Route::get('/p/{post}', 'PostController@show')->name('posts.show');
    Route::get('/explore/people/suggested', 'ExploreController@show')->name('explore.show');
    Route::get('/', 'HoneController@index')->name('home');
    Route::get('/message','MessageController@index')->name('message');
    Route::get('/message/{user}' , 'MessageController@getMessage')->name('message.get');
    Route::get('/notification','NotiController@index')->name('notification');
    Route::get('search','SearchController@search')->name('serach.name');
});

Route::post('/accounts/{user}', 'ProfileController@update')->name('profile.update');\
Route::post('/accounts/password/{user}', 'ProfileController@updatepass')->name('profile.updatepass');
Route::post('/follow/{user}', 'FollowsController@store');
Route::post('/like/{user}/post/{post}', 'LikeController@store');
Route::post('/like/{user}/comment/{comment}', 'LikeController@storeLikeComment');
Route::post('/posts/{post}' ,'PostController@createcomment')->name('posts.comment');
Route::post('replyCmt/{comment}','PostController@createreplycomment')->name('posts.reply');
Route::post('message', 'MessageController@sendMessage')->name('message.send');
Route::post('notification','NotiController@getNoti')->name('notification.get');
Route::post('reccent','MessageController@getReccent')->name('message.reccent');
Route::post('request','MessageController@getRequest')->name('message.request');
Route::post('getpost','HoneController@getPost')->name('post.get');
Route::post('report','ReportController@store')->name('report.create');
Route::post('reportPost','ReportController@storePost')->name('report.create.post');


//dashboard
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function(){

    Route::namespace('Auth')->group(function(){
        Route::get('/login','LoginController@showLoginForm')->name('login');
        Route::post('/login','LoginController@login')->name('make.login');
        Route::post('/logout','LoginController@logout')->name('logout');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::get('/','HomeController@index')->name('home');
        Route::get('/user','UserController@index')->name('user');
        Route::get('/post','PostController@index')->name('post');
        Route::get('/chat','ChatController@index')->name('chat');

        Route::middleware('isSuperAdmin')->group(function () {
            Route::get('/setting','SettingController@index')->name('setting');
        });

        Route::post('/addAdmin','SettingController@addAdmin')->name('addadmin');
        Route::post('/deleteAdmin','SettingController@deleteAdmin')->name('deleteAdmin');
        Route::post('/editAdmin/{admin}','SettingController@editAdmin')->name('editAdmin');
        Route::post('/getAdmin/{admin}','SettingController@getAdmin')->name('getAdmin');

        Route::post('/blockUser/{user}','UserController@blockUser')->name('blockUser');
        Route::post('/getUser/{user}','UserController@getUser')->name('getUser');

        Route::get('/report', 'ReportController@index')->name('report');
        Route::get('/getReport/{report}', 'ReportController@getReport')->name('getReport');
    });
});


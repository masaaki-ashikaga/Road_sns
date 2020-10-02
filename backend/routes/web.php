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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('User')->prefix('user')->name('user.')->group(function(){
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false,
    ]);

    Route::middleware('auth:user')->group(function(){
        Route::group(['middleware' => ['auth']], function(){
            Route::resource('home', 'HomeController', ['only' => 'index']);
            Route::resource('posts', 'PostsController');
            Route::get('users/{user}/followed', 'UsersController@followed')->name('followed');
            Route::get('users/{user}/following', 'UsersController@following')->name('following');
            Route::resource('users', 'UsersController');
            Route::resource('comments', 'CommentsController', ['only' => ['edit', 'store', 'update', 'destroy']]);
            Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);
            Route::resource('brands', 'BrandsController', ['only' => ['index', 'show']]);
        });
    });
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false,
    ]);

    Route::middleware('auth:admin')->group(function(){
        Route::resource('home', 'HomeController', ['only' => 'index']);
    });
});

Route::resource('posts', 'PostsController');
Route::get('users/{user}/followed', 'UsersController@followed')->name('followed');
Route::get('users/{user}/following', 'UsersController@following')->name('following');
Route::resource('users', 'UsersController');
Route::resource('comments', 'CommentsController', ['only' => ['edit', 'store', 'update', 'destroy']]);
Route::resource('favorites', 'FavoritesController', ['only' => ['store', 'destroy']]);
Route::resource('brands', 'BrandsController', ['only' => ['index', 'show']]);

Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

Route::get('/', 'PostController@index');

Auth::routes();
Route::prefix('post')->group(function () {
    Route::get('all', 'PostController@index');
    Route::get('show/{id}', 'PostController@show')->name('front.post.show');
    Route::get('category/{id}', 'PostController@category')->name('front.post.category');
});
Route::prefix('admin')->group(function () {

    Route::middleware('auth')->group(function () {

        Route::get('/', 'Admin\HomeController@index')->name('admin');
        Route::resource('post', 'Admin\PostController');
        Route::resource('category', 'Admin\CategoryController');

    });

});

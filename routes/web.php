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
})->name('welcome');

Auth::routes();



Route::middleware(['auth', 'IsAdmin'])->group(function(){

	
    Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('categories', 'CategoryController');
	Route::post('store_category', 'CategoryController@api_store');
	Route::get('all_categories', 'CategoryController@all_categories');

	Route::resource('tags', 'TagController');
	Route::post('store_tags', 'TagController@api_store');
	Route::get('all_tags', 'TagController@all_tags');

	Route::resource('posts', 'PostController');
	Route::get('trashed-posts', 'PostController@trashed')->name('posts.trashed');
	Route::put('restore-post/{post}', 'PostController@restore')->name('post.restore');

	Route::get('posts/category/{category}', 'PostController@category')->name('posts.category');    
    Route::get('posts/tag/{tag}', 'PostController@tag')->name('posts.tag');

});

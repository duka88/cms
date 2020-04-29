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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');;
 Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
 \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::middleware(['auth'])->group(function(){
  Route::get('/laravel-filemanager', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
   
	
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
    
    Route::resource('clients', 'ClientController');

    Route::resource('services', 'ServiceController');
    Route::post('services/store', 'ServiceController@store')->name('services.store');
    Route::post('store_services', 'ServiceController@api_store');
	Route::get('all_services', 'ServiceController@all_services');

	Route::resource('types', 'TypeController');
    Route::post('store_type', 'TypeController@api_store');
	Route::get('all_types', 'TypeController@all_types');


	Route::resource('links', 'LinkController');
    Route::post('store_link', 'LinkController@api_store');
	Route::get('all_links', 'LinkController@all_links');


	Route::resource('industries', 'IndustryController');
    Route::post('store_industry', 'IndustryController@api_store');
	Route::get('all_industries', 'IndustryController@all_industries');

    Route::resource('users', 'UserController');


    Route::post('name', 'EditClientController@name'); 
    Route::post('company', 'EditClientController@company');
    Route::post('email', 'EditClientController@email');
    Route::post('industry', 'EditClientController@industry');
    Route::post('services', 'EditClientController@services');
    Route::post('links', 'EditClientController@links');
    Route::post('budget', 'EditClientController@budget');
    Route::post('time', 'EditClientController@time');
    Route::post('credentials', 'EditClientController@credentials');          

});

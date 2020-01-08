<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware(['Cors'])->group(function(){
	Route::post('send-mail', 'MailController@contact_mail');
	Route::get('posts', 'PostController@all_posts');
	Route::get('post/{slug}', 'PostController@post_single');

});


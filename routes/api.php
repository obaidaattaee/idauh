<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(['namespace' => '\App\Http\Controllers'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::get('/lights' , 'LightController@index');
    Route::get('categories' , 'CategoryController@index');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
        Route::post('change_password', 'AuthController@changePassword');


        Route::post('categories/store' , 'CategoryController@store');
        Route::post('categories/{category}/update' , 'CategoryController@update');


        Route::post('lights/store' , 'LightController@store');
        Route::post('lights/{light}/update' , 'LightController@update');
        Route::get('lights/{light}/like' , 'LightController@likeLight');
        Route::get('lights/{light}/view' , 'LightController@viewLight');

        Route::get('posts' , 'PostController@index');
        Route::post('posts/store' , 'PostController@store');
        Route::post('posts/{post}/update' , 'PostController@update');
        Route::get('posts/{post}/like' , 'PostController@likePost');
        Route::get('posts/{post}/view' , 'PostController@viewPost');

    });
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

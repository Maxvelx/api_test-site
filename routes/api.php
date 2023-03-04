<?php

use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'prefix'     => 'auth',
    'namespace'  => 'App\Http\Controllers'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//Admin Panel

Route::group([

    'middleware' => 'jwt.auth',
    'prefix'     => 'admin',
    'namespace'  => 'App\Http\Controllers\API\Admin\Post',

], function () {

    Route::apiResource('post_category', \Category\PostCategoryController::class);
    Route::resource('posts', \Post\PostController::class);

});

//Public site
Route::group([

    'prefix'    => 'v1',
    'namespace' => 'App\Http\Controllers\API\Client\Post',

], function () {

    Route::get('posts_grid', 'IndexHomeController@posts_1_2');
    Route::get('posts_3', 'IndexHomeController@post_3');

});



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
Route::middleware('auth:api')->group(function () {
    Route::apiResource('post', 'api\PostController');
});

Route::get('users', function()
{
    return 'Users!';
});
Route::apiResource('post','PostController');
Route::post('post2/', 'PostController@store');
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('post/{id}', 'PostController@show');





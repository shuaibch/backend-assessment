<?php

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;


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
Route::post('/login', 'UserController@login');
Route::middleware('auth:api')->get('/user/view/{id}', 'UserController@view');
Route::middleware('auth:api')->get('/users', 'UserController@index');
Route::middleware('auth:api')->post('/user/create', 'UserController@create');
Route::middleware('auth:api')->post('/user/update/{id}', 'UserController@edit');
Route::middleware('auth:api')->post('/user/delete/{id}', 'UserController@delete');
Route::middleware('auth:api')->post('/user/import', 'UserController@import');
Route::get('/user/export', 'UserController@export');




// Route::get('/users', function() {
//     return UserResource::collection(User::paginate());
// });

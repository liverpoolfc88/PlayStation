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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('/users/show', 'UserController@show');


    Route::post('room/update', 'RoomController@update');
    Route::get('room/index', 'RoomController@index');
    Route::post('room/work', 'RoomController@work');
    Route::post('room/busy', 'RoomController@busy');
    Route::delete('room/delete/{id}', 'RoomController@destroy');


    Route::get('/role', 'UserController@role');
    Route::post('/users/update-role', 'UserController@updateRole');
    Route::post('/users', 'UserController@index');
    Route::post('/users/update', 'UserController@update');
    Route::post('/users/password', 'UserController@password');
    Route::delete('/users/delete/{id}', 'UserController@destroy');


    Route::post('/roles/update-role-permission', 'RoleController@updateRolePermission');
    Route::get('/roles', 'RoleController@index');
    Route::get('/roles/get-ref', 'RoleController@getRef');
    Route::get('/roles/show', 'RoleController@show');
    Route::delete('/roles/delete/{id}', 'RoleController@destroy');
    Route::post('/roles/update', 'RoleController@update');

    Route::post('permissions', 'PermissionController@index');
    Route::get('permissions/show', 'PermissionController@show');
    Route::delete('permissions/delete/{id}', 'PermissionController@destroy');
    Route::post('permissions/update', 'PermissionController@update');

});













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


/**
 * user authentication
 *
*/
Route::group([
    'namespace' => 'Api\Authentication',
    'middleware' => 'api',
], function () {
    Route::post('login','LoginController@login');
    Route::post('register','RegisterController@register');

    //password reset
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

/**
 * user tasks,user info update
*/
Route::group([
    'namespace' => 'Api',
    'middleware' => 'api'
],function (){
    Route::post('updateAuthUser/{id}','UserUpdateController@updateAuthUser');

    //task
    Route::post('createTask/{id}', 'TaskController@createTask');//->uses the users id
    Route::post('updateTask/{id}', 'TaskController@updateTask');//->uses the task id
    Route::post('viewTask/{id}', 'TaskController@viewTask');//->uses the task id
    Route::post('deleteTask/{id}', 'TaskController@deleteTask');//->uses the task id
    Route::post('show/{id}', 'TaskController@show');//->uses the users id
    Route::post('taskStatus/{status}', 'TaskController@taskStatus');//-> status types incoming or past
    Route::get('search/appointments={query}', 'TaskController@search');//->search and filter task

    //product
    Route::post('store/{user_id}', 'ProductController@store');
});

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

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
});

Route::middleware('auth:api')->group(function () {
    Route::post('token/refresh', 'ApiTokenController@refresh');

    Route::get('symptoms', 'SymptomsController@getAll');
    Route::post('symptoms', 'SymptomsController@create');

    Route::get('user/symptoms', 'UserSymptomsController@getAll');
    Route::post('user/creategroup', 'GroupsController@create');
    Route::get('user/groups', 'GroupsController@getAll');
    Route::post('user/groupuser/{groupuser}', 'GroupUser@addGroupUser');
    Route::get('user/symptoms/{symptom}', 'UserSymptomsController@getOneFromList');
    Route::post('user/symptoms/{symptom}/records', 'UserSymptomsController@addSymptomRecord');
    Route::get(
        'user/symptoms/{symptom}/records',
        'UserSymptomsController@getSymptomRecords'
    );


});

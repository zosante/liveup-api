<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

Route::name('api.')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
    });

    Route::middleware('auth:api')->group(function () {
        Route::post('token/refresh', 'ApiTokenController@refresh');

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('', function (Request $request) {
                return $request->user();
            });

            Route::post('groups', 'GroupsController@create');
            Route::get('groups', 'GroupsController@getAll');
            Route::post('groups/{group}', 'GroupUserController@addGroupUser');

            Route::get('symptoms', 'UserSymptomsController@getAll');
            Route::get('symptoms/{symptom}', 'UserSymptomsController@getOneFromList');
            Route::post('symptoms/{symptom}/records', 'UserSymptomsController@addSymptomRecord');
            Route::get('symptoms/{symptom}/records', 'UserSymptomsController@getSymptomRecords');
            Route::get('symptoms/{symptom}/records/latest', 'UserSymptomsController@getLatestRecord');
        });

        Route::get('symptoms', 'SymptomsController@getAll');
        Route::post('symptoms', 'SymptomsController@create');
    });

    Route::get('/', function () {
        return [
            'Welcome to LiveUp API. Please check documentations or test you are connected with /api/tests endpoints.'
        ];
    });

    Route::any('tests', function (Request $request) {
        return [
            'method' => $request->method(),
            'data' => $request->all()
        ];
    });
});

Route::fallback(fn() => response()->json(['message' => 'Resource path does not exist.'], Response::HTTP_NOT_FOUND));

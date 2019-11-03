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


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

Route::group([
// ,'role:teacher'
    'middleware' => ['api'],

], function ($router) {

 Route::post('{id}/quiz/create', 'QuizController@store');
 Route::put('quiz/{quiz}/edit', 'QuizController@edit');
 Route::get('quiz/{id}/show', 'QuizController@show');
 Route::post('questations/{q_id}/create', 'QuestationController@store');
 Route::put('questations/{questation}/edit', 'QuestationController@edit');
 Route::post('answers/{q_id}/create', 'AnswerController@store');
 Route::put('answers/{answer}/edit', 'AnswerController@edit');

});
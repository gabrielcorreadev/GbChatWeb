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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('register', 'Api\\AuthController@register');
    Route::post('login', 'Api\\AuthController@login');
    Route::post('logout', 'Api\\AuthController@logout');
    Route::post('refresh', 'Api\\AuthController@refresh');
    Route::get('me', 'Api\\AuthController@me');
});

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'users'], function() {
    Route::get('', 'Api\\UserController@index');
    Route::post('', 'Api\\UserController@register');
});

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'messages'], function() {
    Route::get('/', 'Api\\MessagesController@index');
    Route::get('/{id}', 'Api\\MessagesController@getMessageById');
    Route::post('', 'Api\\MessagesController@sendMessage');
});

Route::group(['middleware' => ['jwt.verify'], 'prefix' => 'conversations'], function() {
    Route::get('/', 'Api\\ConversationController@index');
    Route::get('/user/{id}', 'Api\\ConversationController@getConversationByUserId');
    Route::get('/{id}', 'Api\\ConversationController@getConversationById');
    Route::post('', 'Api\\ConversationController@sendConversation');
});

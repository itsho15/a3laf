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

Route::post('register', 'UserAPIController@register');
Route::post('login', 'UserAPIController@authenticate');

Route::resource('categories', 'CategoryAPIController');
Route::resource('countries', 'CountryAPIController');
Route::resource('cities', 'CityAPIController');
Route::resource('states', 'StateAPIController');
Route::resource('settings', 'SettingsApiController');
Route::post('ads/update/{id}', 'AdAPIController@update');
Route::resource('ads', 'AdAPIController');
Route::resource('banks', 'BankAPIController');
Route::resource('hosnies', 'HosnyAPIController');
Route::resource('types', 'TypeAPIController');

Route::group(['middleware' => ['jwt.verify']], function () {
	Route::get('user', 'UserAPIController@getAuthenticatedUser');
	Route::post('user/update', 'UserAPIController@update');
	Route::get('user/notifications', 'UserAPIController@getNotifications');
	Route::post('user/notifications/readed', 'UserAPIController@MarkAsReadNotification');
	Route::post('rate', 'UserAPIController@Rating');
	Route::resource('favorites', 'FavoriteAPIController');
	Route::resource('comments', 'CommentAPIController');
	Route::resource('conversations', 'ConversationAPIController');
	Route::resource('messages', 'MessageAPIController');
	Route::resource('followers', 'FollowerAPIController');

});

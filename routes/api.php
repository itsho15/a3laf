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
Route::post('set-new-password', 'UserAPIController@NewPassword');

Route::resource('categories', 'CategoryAPIController');
Route::resource('countries', 'CountryAPIController');
Route::resource('cities', 'CityAPIController');
Route::resource('states', 'StateAPIController');
Route::resource('settings', 'SettingsApiController');
Route::post('ads/update/{id}', 'AdAPIController@update');
Route::get('my-ads', 'AdAPIController@myAds');
Route::get('ads/search', 'AdAPIController@Search');
Route::get('recent-ads', 'AdAPIController@RecentAds');
Route::get('other-ads', 'AdAPIController@OtherAds');
Route::post('ads/change-status/{id}', 'AdAPIController@ChangeStatus');

Route::resource('ads', 'AdAPIController');
Route::post('upload/image/{ad_id}', 'AdAPIController@upload_file');
Route::post('delete/image', 'AdAPIController@deleteImage');

Route::resource('banks', 'BankAPIController');
Route::resource('types', 'TypeAPIController');
Route::resource('comments', 'CommentAPIController');

Route::post('forgot_password', 'UserAPIController@forgot_password');
Route::post('change_password', 'UserAPIController@change_password');
Route::resource('complaints', 'ComplaintAPIController');
Route::resource('tests', 'testAPIController');
Route::group(['middleware' => ['jwt.verify']], function () {
	Route::get('user', 'UserAPIController@getAuthenticatedUser');
	Route::post('user/update', 'UserAPIController@update');
	Route::get('user/notifications', 'UserAPIController@getNotifications');
	Route::post('user/notifications/readed', 'UserAPIController@MarkAsReadNotification');
	Route::post('ad/rate', 'AdAPIController@Rating');
	Route::post('user/rate', 'UserAPIController@Rating');
	Route::resource('favorites', 'FavoriteAPIController');
	Route::resource('conversations', 'ConversationAPIController');
	Route::resource('messages', 'MessageAPIController');
	Route::resource('followers', 'FollowerAPIController');
});

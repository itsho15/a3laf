<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();
Route::get('/', 'HomeController@index');
Route::get('/site-map', 'HomeController@SiteMap');

Route::group(['namespace' => 'Front'], function () {
	Route::post('save-device-token', 'UserController@saveToken');
	Route::post('mark_notification_as_read', 'UserController@MarkAsReadNotification');
	Route::resource('ads', 'AdController', ["as" => 'front']);
	Route::get('my-ads', 'AdController@MyAds', ["as" => 'front']);
	Route::get('ads/{id}/{slug?}', [
		'uses' => 'AdController@show',
	]);
	Route::resource('categories', 'CategoryController');
	Route::resource('comments', 'CommentController', ["as" => 'front']);
	Route::get('/search', 'AdController@search');
	Route::get('pages/{id}/{slug?}', [
		'uses' => 'PageController@show',
	]);
	Route::get('/conversation/{id}', 'ChatsController@index');
	Route::post('/conversation/create', 'ChatsController@Store', ["as" => 'front']);
	Route::get('conversation/messages/{id}', 'ChatsController@fetchMessages');
	Route::post('conversation/messages', 'ChatsController@sendMessage');

	Route::resource('complaints', 'ComplaintController', ["as" => 'front']);
});

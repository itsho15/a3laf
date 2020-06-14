<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		\Schema::enableForeignKeyConstraints();
		\Schema::defaultStringLength(191);
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		Gate::define('ltm-admin-translations', function ($user) {
			/* @var $user \App\User */
			return $user;
		});

		Gate::define('ltm-bypass-lottery', function ($user) {
			/* @var $user \App\User */
			return $user;
		});

		Gate::define('ltm-list-editors', function ($user, $connection_name, &$user_list) {
			/* @var $user \App\User */
			/* @var $connection_name string */
			/* @var $query  \Illuminate\Database\Query\Builder */
			$query = $user->on('laravel')->getQuery();

			// modify the query to return only users that can edit translations and can be managed by $user
			// if you have a an editor scope defined on your user model you can use it to filter only translation editors
			//$user_list = $user->scopeEditors($query)->orderby('id')->get(['id', 'email', 'name']);
			$user_list = $query->orderby('id')->get(['id', 'email']);

			// if the returned list is empty then no per locale admin will be shown for the current user.
			return $user_list;
		});
	}
}

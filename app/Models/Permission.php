<?php
namespace App\Models;
class Permission extends \Spatie\Permission\Models\Permission {
	protected $fillable = ['name', 'guard_name'];

	public static function defaultPermissions() {
		return [
			'view_users',
			'add_users',
			'edit_users',
			'delete_users',
			'view_roles',
			'add_roles',
			'edit_roles',
			'delete_roles',
			'view_categories',
			'add_categories',
			'edit_categories',
			'delete_categories',
			'view_auctions',
			'add_auctions',
			'edit_auctions',
			'delete_auctions',
			'view_cities',
			'add_cities',
			'edit_cities',
			'delete_cities',
			'view_countries',
			'add_countries',
			'edit_countries',
			'delete_countries',
			'view_states',
			'add_states',
			'edit_states',
			'delete_states',
		];
	}
}

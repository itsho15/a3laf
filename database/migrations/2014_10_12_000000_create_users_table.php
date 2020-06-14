<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->string('type_name')->nullable();
			$table->string('licenseـnumber')->nullable();
			$table->text('licenseـimage')->nullable();
			$table->string('means_of_communication')->nullable();
			$table->string('civil_registry')->nullable();
			$table->string('phone')->unique();
			$table->string('email')->unique();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->rememberToken();
			$table->enum('status', ['approved', 'disapproved', 'blocked', 'pending'])->default('approved');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('users');
	}
}

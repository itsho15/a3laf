<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFollowersTable extends Migration {

	public function up() {
		Schema::create('followers', function (Blueprint $table) {
			$table->id();
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('followers');
	}
}
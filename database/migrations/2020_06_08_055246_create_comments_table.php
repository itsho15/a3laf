<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	public function up() {
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->text('body');
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('comments');
	}
}
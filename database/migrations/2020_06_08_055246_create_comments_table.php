<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	public function up() {
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->text('body');
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->foreignId('ad_id')->constrained()->onDelete('cascade');
			$table->timestamps();
		});
	}

	public function down() {
		Schema::drop('comments');
	}
}
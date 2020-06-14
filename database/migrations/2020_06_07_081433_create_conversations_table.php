<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConversationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('conversations', function (Blueprint $table) {
			$table->id();
			$table->foreignId('to_id')->constrained('users')->onDelete('cascade');
			$table->foreignId('from_id')->constrained('users')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('conversations');
	}
}

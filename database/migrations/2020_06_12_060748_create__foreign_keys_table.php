<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeysTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		/*
			Schema::table('users', function (Blueprint $table) {
				$table->foreignId('type_id')->nullable()->constrained();
				$table->foreignId('city_id')->nullable()->constrained();
			});

			Schema::table('ads', function (Blueprint $table) {
				$table->foreignId('city_id')->constrained();
				$table->foreignId('user_id')->constrained()->onDelete('cascade');
				$table->foreignId('category_id')->constrained();
			});

			Schema::table('favorites', function (Blueprint $table) {
				$table->foreignId('user_id')->constrained()->onDelete('cascade');
				$table->foreignId('ad_id')->constrained()->onDelete('cascade');
			});

			Schema::table('followers', function (Blueprint $table) {
				$table->foreignId('user_id')->constrained()->onDelete('cascade');
				$table->foreignId('follower_id')->constrained('users')->onDelete('cascade');
			});

			Schema::table('reports', function (Blueprint $table) {
				$table->foreignId('user_id')->constrained()->onDelete('cascade');
				$table->foreignId('ad_id')->constrained()->onDelete('cascade');
			});

			Schema::table('accounts', function (Blueprint $table) {
				$table->foreignId('bank_id')->constrained()->onDelete('cascade');
			});
		*/

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists('_foreign_keys');
	}
}

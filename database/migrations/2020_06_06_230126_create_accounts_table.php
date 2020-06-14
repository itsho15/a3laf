<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAccountsTable extends Migration {

	public function up() {
		Schema::create('accounts', function (Blueprint $table) {
			$table->id();
			$table->string('number');
			$table->string('iban');
			$table->text('note');
			$table->timestamps();
		});
	}

	public function down() {
		Schema::dropIfExists('accounts');
	}
}
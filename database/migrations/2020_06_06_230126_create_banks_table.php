<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBanksTable extends Migration {

	public function up()
	{
		Schema::create('banks', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->text('image')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('banks');
	}
}
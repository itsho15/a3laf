<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTypesTable extends Migration {

	public function up()
	{
		Schema::create('types', function(Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('types');
	}
}
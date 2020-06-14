<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdsTable extends Migration {

	public function up() {
		Schema::create('ads', function (Blueprint $table) {
			$table->id();
			$table->string('name');
			$table->longText('body');
			$table->enum('status', array('live', 'sold', 'canceled', 'pending'))->default('pending');
			$table->enum('ad_type', array('sell', 'buy'));
			$table->text('contact_types');
			$table->decimal('price', 10, 2)->default('0');
			$table->timestamps();
		});
	}

	public function down() {
		Schema::dropIfExists('ads');
	}
}
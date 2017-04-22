<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBadgesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('badges', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('image');
			$table->integer('season_id')->unsigned();
			$table->integer('type_id')->unsigned();
			$table->timestamps();

			$table->foreign('season_id')->references('id')->on('seasons');
			$table->foreign('type_id')->references('id')->on('types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('badges');
	}
}

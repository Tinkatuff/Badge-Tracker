<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengerSocialTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('challenger_social', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('challenger_id')->unsigned();
			$table->string('service');
			$table->string('account');
			$table->timestamps();

			$table->foreign('challenger_id')->references('id')->on('challengers');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('challenger_social');
	}
}

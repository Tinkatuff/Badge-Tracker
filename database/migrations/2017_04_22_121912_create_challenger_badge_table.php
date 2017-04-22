<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengerBadgeTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('challenger_badge', function (Blueprint $table) {
			$table->integer('challenger_id')->unsigned();
			$table->integer('badge_id')->unsigned();
			$table->integer('awarded_by_id')->unsigned();
			$table->dateTime('awarded_at');

			$table->unique(['challenger_id', 'badge_id']);
			$table->foreign('challenger_id')->references('id')->on('challengers');
			$table->foreign('badge_id')->references('id')->on('badges');
			$table->foreign('awarded_by_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('challenger_badge');
	}
}

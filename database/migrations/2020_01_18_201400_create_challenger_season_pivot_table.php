<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengerSeasonPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenger_season', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('challenger_id')->unsigned();
            $table->integer('season_id')->unsigned();
            $table->timestamps();

            $table->foreign('challenger_id')->references('id')->on('challengers');
            $table->foreign('season_id')->references('id')->on('seasons');
            $table->unique(['challenger_id', 'season_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenger_season');
    }
}

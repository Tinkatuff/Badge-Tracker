<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCurrentSeasonTypePointsToChallengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challengers', function (Blueprint $table) {
            $table->integer('current_season_type_points')->after('current_season_badges')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challengers', function (Blueprint $table) {
            $table->dropColumn('current_season_type_points');
        });
    }
}

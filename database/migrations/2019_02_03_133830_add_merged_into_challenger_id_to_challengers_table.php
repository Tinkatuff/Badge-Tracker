<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMergedIntoChallengerIdToChallengersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challengers', function (Blueprint $table) {
            $table->unsignedInteger('merged_into_challenger_id')->before('created_at')->nullable();
            $table->foreign('merged_into_challenger_id')->references('id')->on('challengers');
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
            $table->dropForeign(['merged_into_challenger_id']);
            $table->dropColumn('merged_into_challenger_id');
        });
    }
}

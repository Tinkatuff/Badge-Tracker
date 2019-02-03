<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdColumnToChallengerBadgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challenger_badge', function (Blueprint $table) {
            $table->dropPrimary(['challenger_id', 'badge_id']);
        });

        Schema::table('challenger_badge', function (Blueprint $table) {
            $table->increments('id')->first();
            $table->unique(['challenger_id', 'badge_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challenger_badge', function ( $table) {
            $table->dropColumn('id');
            $table->dropUnique(['challenger_id', 'badge_id']);
            $table->primary(['challenger_id', 'badge_id']);
        });
    }
}

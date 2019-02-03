<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengerDedupeItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenger_dedupe_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_type');
            $table->string('item_id');
            $table->unsignedInteger('old_challenger_id');
            $table->unsignedInteger('new_challenger_id');
            $table->timestamps();

            $table->foreign('old_challenger_id')->references('id')->on('challengers');
            $table->foreign('new_challenger_id')->references('id')->on('challengers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('challenger_dedupe_items');
    }
}

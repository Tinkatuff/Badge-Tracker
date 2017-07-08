<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacebookColumnsToUsersTable extends Migration
{
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			// If the primary id in your you user table is different than the Facebook id
			// Make sure it's an unsigned() bigInteger()
			$table->bigInteger('facebook_user_id')->unsigned()->after('id')->index();
			// Normally you won't need to store the access token in the database
			$table->string('access_token')->nullable()->after('facebook_user_id');
			$table->dropColumn('password');
		});
	}

	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropColumn(
				'facebook_user_id',
				'access_token'
			);
			
			$table->string('password');
		});
	}
}
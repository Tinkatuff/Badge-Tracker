<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(TypesSeeder::class);
		$this->call(SeasonsSeeder::class);
		$this->call(BadgesSeeder::class);
	}
}

<?php

use Illuminate\Database\Seeder;

use App\Models\Season;

class SeasonsSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// The TRAZ League has had these seasons
		$seasons = [
			[
				'name' => 'Season 1',
				'start_date' => '2015-02-27',
				'end_date' => '2015-07-12'
			],
			[
				'name' => 'Season 2',
				'start_date' => '2015-09-13',
				'end_date' => '2016-02-13'
			],
			[
				'name' => 'Season 3',
				'start_date' => '2016-03-13',
				'end_date' => '2016-08-14'
			],
			[
				'name' => 'Season 4',
				'start_date' => '2016-05-13'
			]
		];

		foreach ($seasons as $season) {
			Season::create($season);
		}
	}
}

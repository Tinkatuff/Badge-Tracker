<?php

use Illuminate\Database\Seeder;

use App\Models\Season;
use App\Models\Type;
use App\Models\Badge;

class BadgesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$types = Type::all();
		$season = Season::orderBy('id', 'DESC')->take(1)->first();

		foreach ($types as $type) {
			Badge::create([
				'type_id' => $type->id,
				'name' => sprintf('%s Badge', $type),
				'season_id' => $season->id,
				'image' => sprintf('%s.png', strtolower($type))
			]);
		}
	}
}

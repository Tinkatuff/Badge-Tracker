<?php

use Illuminate\Database\Seeder;

use App\Models\Season;
use App\Models\Type;
use App\Models\Badge;
use App\Models\Challenger;
use App\Models\ChallengerData;
use App\Models\ChallengerSocial;
use App\User;

class ChallengerSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$admin = User::first() ?: factory(User::class)->create();
		$challengers = factory(Challenger::class, 10)->create()
			->each(function($c) use ($admin) {
				$badge_count = rand(0, rand(5, rand(10, 18)));
				
				$badge_ids = Badge::inRandomOrder()
					->take($badge_count)
					->pluck('id');
				
				$badges = $badge_ids->mapWithKeys(function($id) use ($admin){
					return [$id => [
						'awarded_by_id' => $admin->id,
						'awarded_at' => Carbon\Carbon::now()
					]];
				});

				$c->badges()->sync($badges);
				$c->data()->saveMany(factory(ChallengerData::class, rand(0, 3))->make());
				$c->social()->saveMany(factory(ChallengerSocial::class, rand(0, 3))->make());
				$c->current_season_badges = $c->seasonBadgeCount();
				$c->save();
			});
	}
}

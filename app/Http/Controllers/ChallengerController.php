<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Challenger;
use App\Models\Season;
use Auth;

class ChallengerController extends Controller
{
	function index() {
		$challengers = Challenger::orderBy('current_season_badges', 'DESC')
			->orderBy('name', 'ASC');

		if (Auth::guest()) {
			$challengers->where('current_season_badges', '>', 0);
		}
		
		return view('challenger.index', [
			'challengers' => $challengers->get(),
			'season_badges' => Season::currentSeason()->badges()->count()
		]);
	}

	function show(Challenger $challenger) {
		$current_season = Season::currentSeason();
		$active_badges = $challenger->seasonBadges($current_season);
		$inactive_badges = $challenger->eligibleBadges($current_season);

		return view('challenger.show', [
			'challenger' => $challenger,
			'current_season' => $current_season,
			'season_badges' => $active_badges,
			'season_badges_inactive' => $inactive_badges
		]);
	}
}

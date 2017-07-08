<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Challenger;
use App\Models\Season;

class ChallengerController extends Controller
{
	function index() {
		return view('challenger.index', [
			'challengers' => Challenger::orderBy('current_season_badges', 'DESC')
				->orderBy('name', 'ASC')
				->get(),
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

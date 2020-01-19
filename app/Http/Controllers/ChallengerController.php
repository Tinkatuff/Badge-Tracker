<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Challenger;
use App\Models\Season;
use Auth;
use Gate;

class ChallengerController extends Controller
{
	function index() {
		$challengers = Challenger::orderBy('current_season_badges', 'DESC')
			->orderBy('name', 'ASC');

		if (Gate::allows('admin')) {
			$inactive = (clone $challengers)->whereDoesntHave('currentSeason')->get();
			$inactive->map(function($challenger) {
				$challenger->is_active = false;
				return $challenger;
			});
		}

		$challengers->whereHas('currentSeason');
		
		return view('challenger.index', [
			'challengers' => $challengers->get(),
			'inactive' => $inactive ?? collect([]),
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

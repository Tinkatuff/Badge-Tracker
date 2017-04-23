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

	function show() {
		return 'placeholder';
	}
}

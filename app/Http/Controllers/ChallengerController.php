<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Challenger;

class ChallengerController extends Controller
{
	function index() {
		return view('challenger.index', [
			'challengers' => Challenger::all(),
			'season_badges' => 18
		]);
	}

	function show() {
		return 'placeholder';
	}
}

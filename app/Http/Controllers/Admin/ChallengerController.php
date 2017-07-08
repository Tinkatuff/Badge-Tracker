<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Challenger;
use App\Models\Badge;
use Carbon\Carbon;

class ChallengerController extends Controller
{
	function create() {
		return view('challenger.create');
	}
	
	function store(Request $request) {
		$this->validate($request, [
			'name' => 'required|max:100',
			'joined_season_id' => 'required|exists:seasons,id',
			'join_date' => 'required|date'
		]);

		$challenger = Challenger::create($request->only('name', 'join_date', 'joined_season_id'));
		return redirect()->route('challenger.show', $challenger)->with('message', 'Successfully registered new challenger');
	}

	function edit(Challenger $challenger) {
		return view('challenger.edit', ['challenger' => $challenger]);
	}

	function update(Request $request, Challenger $challenger) {
		$this->validate($request, [
			'name' => 'required|max:100',
			'joined_season_id' => 'required|exists:seasons,id',
			'join_date' => 'required|date'
		]);

		$challenger->fill($request->only('name', 'join_date', 'joined_season_id'));
		$challenger->save();

		return redirect()->route('challenger.show', $challenger)->with('message', 'Successfully updated challenger profile');
	}

	function award(Challenger $challenger) {
		return view('challenger.award', ['challenger' => $challenger]);
	}

	function submitAward(Request $request, Challenger $challenger) {
		$this->validate($request, [
			'badge_id' => 'required|exists:badges,id',
		]);

		$badge = Badge::find($request->badge_id);

		$challenger->awardBadge($badge);
		
		return redirect()->route('challenger.show', $challenger)->with('message', sprintf('Successfully awarded the %s', $badge));
	}
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Challenger;
use App\Models\Badge;
use App\Models\Type;
use App\Models\Season;
use Carbon\Carbon;

class ChallengerController extends Controller
{
	function create() {
		return view(
			'challenger.create', [
			'types' => Type::all()
		]);
	}
	
	function store(Request $request) {
		$this->validate($request, [
			'name' => 'required|max:100',
			'joined_season_id' => 'required|exists:seasons,id',
			'join_date' => 'required|date',
			'type_id' => 'sometimes|nullable|exists:types,id'
		]);

		$challenger = Challenger::create($request->only('name', 'type_id', 'join_date', 'joined_season_id'));
		return redirect()->route('challenger.show', $challenger)->with('message', 'Successfully registered new challenger');
	}

	function edit(Challenger $challenger) {
		return view('challenger.edit', [
			'challenger' => $challenger,
			'types' => Type::all()
		]);
	}

	function update(Request $request, Challenger $challenger) {
		$this->validate($request, [
			'name' => 'required|max:100',
			'joined_season_id' => 'required|exists:seasons,id',
			'join_date' => 'required|date',
			'type_id' => 'sometimes|nullable|exists:types,id'
		]);

		$challenger->fill($request->only('name', 'type_id', 'join_date', 'joined_season_id'));
		$challenger->save();

		return redirect()->route('challenger.show', $challenger)->with('message', 'Successfully updated challenger profile');
	}

	function award(Challenger $challenger, Badge $badge) {
		return view('challenger.award', [
			'challenger' => $challenger,
			'selectedBadge' => $badge
		]);
	}

	function deleteBadge(Request $request, Challenger $challenger, Badge $badge) {
		$challenger->removeBadge($badge);
		return response()->json(['success' => 'true']);
	}

	function submitAward(Request $request, Challenger $challenger) {
		$this->validate($request, [
			'badge_id' => 'required|exists:badges,id',
			'type_id' => 'sometimes|nullable|in:' . $challenger->type_id
		]);

		$badge = Badge::find($request->badge_id);

		$challenger->awardBadge($badge, $request->type_id);
		
		return redirect()->route('challenger.show', $challenger)->with('message', sprintf('Successfully awarded the %s', $badge));
	}

	function showSeasonRegistration(Challenger $challenger) {
		$current_season = Season::currentSeason();

		return view('challenger.register', [
			'challenger' => $challenger,
			'current_season' => $current_season,
			'types' => Type::all()
		]);
	}

	function register(Challenger $challenger, Request $request) {
		$this->validate($request, [
			'type_id' => 'sometimes|nullable|exists:types,id'
		]);

		$challenger->registerForSeason();
		$challenger->fill($request->only('type_id'));
		$challenger->save();

		return redirect()->route('challenger.show', $challenger)->with('message', 'Successfully registered challenger');	
	}
}

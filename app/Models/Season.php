<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Season extends Model
{
	protected $dates = ['start_date', 'end_date'],
		$guarded = ['id'];

	function badges() {
		return $this->hasMany('App\Models\Badge');
	}

	// We could give this an actual name field, but id works for me for now
	function __toString() {
		return $this->name;
	}

	static function currentSeason() {
		$current = self::where('is_current', true)->first();

		if (!is_null($current)) {
			return $current;
		}

		$new_current = self::whereDate('start_date', '<=', Carbon::now())
			->whereHas('badges')
			->orderBy('start_date', 'DESC')
			->first();

		if (!is_null($new_current)) {
			$new_current->setCurrent();
			return $new_current;
		}

		return null;
	}

	function setCurrent() {
		if ($this->badges()->count() < 1) {
			return false;
		}

		Season::where('is_current', true)->update(['is_current' => false]);
		Challenger::whereNotNull('current_season_badges')->update(['current_season_badges' => null]);
		$this->is_current = true;
		$this->save();
		return true;
	}
}

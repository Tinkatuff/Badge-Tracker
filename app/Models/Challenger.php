<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenger extends Model
{
	protected $guarded = ['id'];

	function joined_season() {
		return $this->belongsTo('App\Models\Season');
	}

	function badges() {
		return $this->belongsToMany('App\Models\Badge', 'challenger_badge');
	}

	function countSeasonBadges($id = null) {
		if (is_null($id)) {
			$id = Season::currentSeason()->id;
		}

		return $this->badges()->where('season_id', $id)->get();
	}

	function getCurrentBadgesAttribute() {
		return $this->badges()->where('season_id', Season::currentSeason()->id)->count();
	}
}

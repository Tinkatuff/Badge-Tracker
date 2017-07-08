<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenger extends Model
{
	protected $guarded = ['id'];

	protected $dates = [ 
		'created_at', 'updated_at', 'join_date'
	];

	function joined_season() {
		return $this->belongsTo('App\Models\Season');
	}

	function data() {
		return $this->hasMany('App\Models\ChallengerData');
	}

	function social() {
		return $this->hasMany('App\Models\ChallengerSocial');
	}

	function badges() {
		return $this->belongsToMany('App\Models\Badge', 'challenger_badge')
			->orderBy('challenger_badge.awarded_at');
	}

	function getCurrentSeasonBadgesAttribute($value) {
		if (is_null($value)) {
			$value = $this->current_season_badges = $this->seasonBadgeCount();
			$this->save();
		}

		return $value;
	}

	public function newPivot(Model $parent, array $attributes, $table, $exists, $using = NULL) {
		if ($parent instanceof Badge) {
			return new ChallengerBadgePivot($parent, $attributes, $table, $exists, $using);
		}

		return parent::newPivot($parent, $attributes, $table, $exists);
	}

	function seasonBadges($season = null) {
		if (is_null($season)) {
			$id = Season::currentSeason()->id;
		} elseif (is_a($season, Season::class)) {
			$id = $season->id;
		} else {
			$id = $season;
		}

		return $this->badges()->where('season_id', $id)->get();
	}

	function seasonBadgeCount() {
		return $this->badges()->where('season_id', Season::currentSeason()->id)->count();
	}

	function __toString() {
		return $this->name;
	}

	function syncBadges($badges, $detach = true) {
		$sync = $this->badges()->sync($badges, $detach);
		$this->current_season_badges = $this->seasonBadgeCount();
		$this->save();
		return $sync;
	}
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Challenger extends Model
{
	protected $guarded = ['id'];

	protected $dates = [ 
		'created_at', 'updated_at', 'join_date'
	];

	function type() {
		return $this->belongsTo('App\Models\Type');
	}

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
			->orderBy('challenger_badge.awarded_at')
			->withPivot('type_id');
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

	function seasonBadges($season = null, $gym_point = null) {
		if (is_null($season)) {
			$id = Season::currentSeason()->id;
		} elseif (is_a($season, Season::class)) {
			$id = $season->id;
		} else {
			$id = $season;
		}

		$badges = $this->badges()->where('season_id', $id);

		if (!is_null($gym_point) && $this->type_id) {
			if ($gym_point) {
				$badges = $badges->wherePivot('type_id', $this->type_id);
			} else {
				$badges = $badges->wherePivot('type_id', '!=', $this->type_id);
			}
		}
		
		return $badges->get();
	}

	function eligibleBadges($season = null) {
		if (is_null($season)) {
			$season = Season::currentSeason();
		} elseif (is_a($season, Season::class)) {
			// do nothing
		} else {
			$season = $season->find($season);
		}

		$active_badges = $this->seasonBadges($season, true);
		return $season->badges()->whereNotIn('id', $active_badges->pluck('id'))->get();
	}

	function seasonBadgeCount() {
		return $this->badges()->where('season_id', Season::currentSeason()->id)->count();
	}

	function __toString() {
		return $this->name;
	}

	function awardBadge(Badge $badge, $type_id = null) {
		if ($type_id != $this->type_id) {
			$type_id = null;
		}

		$badge = $this->badges->find($badge);

		if (is_null($badge)) {
			$this->badges()->attach([
				$badge->id => [
					'awarded_by_id' => \Auth::user()->id,
					'awarded_at' => \Carbon\Carbon::now(),
					'type_id' => $type_id
				]
			]);
		} else if (!is_null($type_id)) {
			$badge->pivot->type_id = $type_id;
			$badge->pivot->save();
		}

		$this->current_season_badges = $this->seasonBadgeCount();
		$this->save();
	}

	function syncBadges($badges, $detach = true) {
		$sync = $this->badges()->sync($badges, $detach);
		$this->current_season_badges = $this->seasonBadgeCount();
		$this->save();
		return $sync;
	}
}

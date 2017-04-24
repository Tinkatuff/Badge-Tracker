<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
	protected $guarded = ['id'];

	function awarded_to() {
		return $this->belongsToMany('App\Models\Challenger', 'challenger_badge');
	}

	public function newPivot(Model $parent, array $attributes, $table, $exists, $using = NULL) {
		if ($parent instanceof Challenger) {
			return new ChallengerBadgePivot($parent, $attributes, $table, $exists, $using);
		}

		return parent::newPivot($parent, $attributes, $table, $exists);
	}

	function type() {
		return $this->belongsTo('App\Models\Type');
	}

	function season() {
		return $this->belongsTo('App\Models\Season');
	}

	function getImageUrlAttribute() {
		return asset(sprintf('badges/%s', $this->image));
	}

	function __toString() {
		return $this->name;
	}
}

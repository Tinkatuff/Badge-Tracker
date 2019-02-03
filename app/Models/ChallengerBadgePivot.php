<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChallengerBadgePivot extends Pivot {

	protected $dates = ['awarded_at'];

	function awarded_by() {
		return $this->belongsTo('App\User');
	}

	function type() {
		return $this->belongsTo('App\Models\Type');
	}

	function challenger() {
		return $this->belongsTo('App\Models\Challenger');
	}

	function badge() {
		return $this->belongsTo('App\Models\Badge');
	}
	/**
	 * Set the keys for a save update query.
	 *
	 * @param  \Illuminate\Database\Eloquent\Builder  $query
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	protected function setKeysForSaveQuery(\Illuminate\Database\Eloquent\Builder $query)
	{
		if ($this->getKey()) {
			return $query->where($this->primaryKey, $this->getAttribute($this->primaryKey));
		} else {
			return parent::setKeysForSaveQuery($query);
		}
	}
}

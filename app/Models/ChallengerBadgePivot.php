<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChallengerBadgePivot extends Pivot {

	protected $dates = ['awarded_at'],
		$touches = ['challenger'];

	function awarded_by() {
		return $this->belongsTo('App\User');
	}

	function challenger() {
		return $this->belongsTo('App\Model\Challenger');
	}

	function badge() {
		return $this->belongsTo('App\Model\Badge');
	}
}

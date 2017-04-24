<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengerData extends Model
{
	protected $dates = ['start_date', 'end_date'],
		$guarded = ['id'],
		$table = 'challenger_data';

	function challenger() {
		return $this->belongsTo('App\Models\Challenger');
	}

	// We could give this an actual name field, but id works for me for now
	function __toString() {
		return $this->data;
	}
}

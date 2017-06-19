<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengerData extends Model
{
	protected $guarded = ['id'],
		$table = 'challenger_data',
		$touches = ['challenger'];

	static function suggestions() {
		return [
			'3DS Friend Code',
			'Switch Friend Code',
			'Real Name',
			'In-Game',
			'Location'
		];
	}

	function challenger() {
		return $this->belongsTo('App\Models\Challenger');
	}

	// We could give this an actual name field, but id works for me for now
	function __toString() {
		return $this->data;
	}
}

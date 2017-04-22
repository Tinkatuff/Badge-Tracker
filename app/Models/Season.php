<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Season extends Model
{
	protected $dates = ['start_date', 'end_date'],
		$guarded = ['id'];

	// We could give this an actual name field, but id works for me for now
	function __toString() {
		return $this->name;
	}

	static function currentSeason() {
		return self::whereDate('start_date', '<=', Carbon::now())
			->orderBy('id', 'DESC')->take(1)->first();
	}
}

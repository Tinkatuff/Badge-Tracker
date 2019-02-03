<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengerDedupeItem extends Model
{
	public function item()
	{
		return $this->morphTo();
	}

	public function oldChallenger()
	{
		return $this->belongsTo('App\Models\Challenger')->withoutGlobalScope('exclude_merged');
	}

	public function newChallenger()
	{
		return $this->belongsTo('App\Models\Challenger')->withoutGlobalScope('exclude_merged');
	}
}
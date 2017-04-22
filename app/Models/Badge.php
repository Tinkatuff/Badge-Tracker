<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
	protected $guarded = ['id'];

	function getImageUrlAttribute() {
		return asset(sprintf('badges/%s', $this->image));
	}
}

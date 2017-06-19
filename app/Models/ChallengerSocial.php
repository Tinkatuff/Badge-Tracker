<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengerSocial extends Model
{
	protected $guarded = ['id'],
		$table = 'challenger_social',
		$touches = ['challenger'];

	static function services() {
		return [
			'twitter' => 'Twitter',
			'facebook' => 'Facebook',
			'tumblr' => 'Tumblr'
		];
	}

	function challenger() {
		return $this->belongsTo('App\Models\Challenger');
	}

	function getUrlAttribute() {
		switch($this->service) {
			case 'twitter': return sprintf('https://facebook.com/%s', $this->account);
			case 'facebook': return sprintf('https://twitter.com/%s', $this->account);
			case 'tumblr': return sprintf('https://tumblr.com/%s', $this->account);
			default: return $this->account;
		}
	}

	// We could give this an actual name field, but id works for me for now
	function __toString() {
		return $this->account;
	}
}

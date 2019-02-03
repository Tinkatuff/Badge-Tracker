<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;
use Auth;

class Leader extends Model
{
	protected $guarded = ['id'];

	function type() {
		return $this->belongsTo('App\Models\Type');
	}

	function getImageUrlAttribute() {
		return asset(sprintf('images/leaders/%s', $this->image));
	}

	function __toString() {
		return $this->name;
	}

	function editable($field, $tag = 'span') {
		$attrs = '';
		if (Auth::check() && Auth::user()->isAdmin()) {
			$attrs = sprintf(
					' data-field="%s"',
					e($field)
				);
		}
		$html = sprintf('<%s%s>%s</%s>', $tag, $attrs, e($this->{$field}), $tag);
		return new HtmlString($html);
	}
}

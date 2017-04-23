<?php

namespace App;

use Route;

function class_if_route( $class, $route ) {
	if (is_array($route)) {
		foreach($route as $r) {
			if (class_if_route($class, $r) == $class) {
				return $class;
			}
		}
		return '';
	}

	if (Route::is($route)) {
		return $class;
	}

	return '';
}
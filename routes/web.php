<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
	'as' => 'home',
	'uses' => function() {
		return redirect()->route('challenger.index');
	}
]);

Route::get('about', [
	'as' => 'about',
	'uses' => function() {
		return view('about.about');
	}
]);

Route::get('/challengers', [
	'uses' => 'ChallengerController@index',
	'as' => 'challenger.index'
]);

Route::get('/challengers/{challenger}', [
	'uses' => 'ChallengerController@show',
	'as' => 'challenger.show'
]);


Route::get('/logout', [
	'uses' => 'FacebookController@logout',
	'as' => 'logout'
]);

Route::get('/login', [
	'uses' => 'FacebookController@login',
	'as' => 'login'
]);

Route::get('/facebook/callback', [
	'uses' => 'FacebookController@callback',
	'as' => 'facebook.callback'
]);

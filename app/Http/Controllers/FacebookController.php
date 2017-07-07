<?php

namespace App\Http\Controllers;

use SammyK\LaravelFacebookSdk\LaravelFacebookSdk as Facebook;
use Facebook\Exceptions\FacebookSDKException as FacebookException;
use App\User;
use Auth;
use Session;

class FacebookController extends Controller
{
	function login(Facebook $fb) {
		return redirect($fb->getLoginUrl(['email']));
	}

	function logout() {
		Auth::logout();
		return redirect()->route('home');
	}

	function callback(Facebook $fb) {
		// Obtain an access token.
		try {
			$token = $fb->getAccessTokenFromRedirect();
		} catch (FacebookException $e) {
			throw $e;
		}

		// Access token will be null if the user denied the request
		// or if someone just hit this URL outside of the OAuth flow.
		if (! $token) {
			// Get the redirect helper
			$helper = $fb->getRedirectLoginHelper();

			if (! $helper->getError()) {
				abort(403, 'Unauthorized action.');
			}

			// User denied the request
			dd(
				$helper->getError(),
				$helper->getErrorCode(),
				$helper->getErrorReason(),
				$helper->getErrorDescription()
			);
		}

		if (! $token->isLongLived()) {
			// OAuth 2.0 client handler
			$oauth_client = $fb->getOAuth2Client();

			// Extend the access token.
			try {
				$token = $oauth_client->getLongLivedAccessToken($token);
			} catch (FacebookException $e) {
				throw $e;
			}
		}

		$fb->setDefaultAccessToken($token);

		// Save for later
		Session::put('fb_user_access_token', (string) $token);

		// Get basic info on the user from Facebook.
		try {
			$response = $fb->get('/me?fields=id,name,email');
		} catch (FacebookException $e) {
			throw $e;
		}

		// Convert the response to a `Facebook/GraphNodes/GraphUser` collection
		$facebook_user = $response->getGraphUser();

		// Only allow a user that has the same email (or same Facebook ID) already
		$user = User::where('email', $facebook_user->getEmail())->first();

		if ($user) {
			$user->facebook_user_id = $facebook_user->getId();
			$user->save();
		} elseif (!User::where('facebook_user_id', $facebook_user->getId())->exists()) {
			abort('Unauthorized', 401);
		}

		// Create the user if it does not exist or update the existing entry.
		// This will only work if you've added the SyncableGraphNodeTrait to your User model.
		$user = User::createOrUpdateGraphNode($facebook_user);

		// Log the user into Laravel
		Auth::login($user);

		return redirect()->route('home')->with('message', 'Successfully logged in with Facebook');
	}
}
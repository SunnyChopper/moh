<?php

namespace App\Custom;

use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminHelper {
	
	public static function redirectAdmin() {
		if (!Auth::guest()) {
			if (Auth::user()->backend_auth != 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public static function attempt_login($username, $password) {
		if (User::where('username', strtolower($username))->count() > 0) {
			$user = User::where('username', strtolower($username))->first();
			if ($user->backend_auth > 0) {
				if (Hash::check($password, $user->password) == true) {
				Auth::login($user);
					Session::put('backend_auth', $user->backend_auth);
					Session::save();
					return 1;
				} else {
					return 0;
				}
			} else {
				return -2;
			}
		} else {
			return -1;
		}
	}

	public static function isAuthorized() {
		if (!Auth::guest()) {
			if (Session::has('backend_auth')) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public static function logout() {
		Auth::logout();
		Session::forget('backend_auth');
		Session::save();
	}

}

?>
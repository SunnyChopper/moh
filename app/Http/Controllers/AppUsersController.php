<?php

namespace App\Http\Controllers;

use App\AppUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppUsersController extends Controller
{
    
	public function create(Request $data) {
		$data = $data["postVariables"];

		if (AppUser::where('email', strtolower($data["email"]))->active()->count() > 0) {
			return response()->json([
				'success' => false,
				'error' => 'Email is already in use.'
			], 200);
		} else {
			$user = new AppUser;
			$user->first_name = $data["first_name"];
			$user->last_name = $data["last_name"];
			$user->email = strtolower($data["email"]);
			$user->password = Hash::make($data["password"]);
			$user->save();

			return response()->json([
				'success' => true,
				'user' => $user->toArray()
			], 200);
		}
	}

	public function read() {
		if (AppUser::find($_GET['user_id'])->count() > 0) {
			return response()->json([
				'success' => true,
				'user' => AppUser::find($_GET['user_id'])->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'User with ID ' . $_GET['user_id'] . ' was not found.'
			], 200);
		}
	}

	public function login(Request $data) {
		$data = $data["postVariables"];

		if (AppUser::where('email', strtolower($data["email"]))->active()->count() > 0) {
			$user = AppUser::where('email', strtolower($data["email"]))->active()->first();
			if (Hash::check($data["password"], $user->password) == true) {
				return response()->json([
					'success' => true,
					'user' => $user->toArray()
 				], 200);
			} else {
				return response()->json([
					'success' => false,
					'error' => 'Incorrect password.'
				], 200);
			}
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Email not found.'
			], 200);
		}
	}

	public function update(Request $data) {
		$data = $data["postVariables"];

		$user = AppUser::find($data["user_id"]);

		if (isset($data["first_name"])) {
			$user->first_name = $data["first_name"];
		}
		
		if (isset($data["last_name"])) {
			$user->last_name = $data["last_name"];
		}

		if (isset($data["points"])) {
			$user->points = $data["points"];
		}

		$user->save();

		return response()->json([
			'success' => true,
			'user' => $user->toArray()
		], 200);
	}

	public function delete(Request $data) {
		$data = $data["postVariables"];

		$user = AppUser::find($data["user_id"]);
		$user->is_active = 0;
		$user->save();

		return response()->json([
			'success' => true
		], 200);
	}

	public function getUserPoints() {
		if (AppUser::find($_GET['user_id'])->count() > 0) {
			return response()->json([
				'success' => true,
				'points' => AppUser::find($_GET['user_id'])->points
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'User with ID ' . $_GET['user_id'] . ' was not found.'
			], 200);
		}
	}

}

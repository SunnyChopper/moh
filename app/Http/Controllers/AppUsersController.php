<?php

namespace App\Http\Controllers;

use App\AppUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AppUsersController extends Controller
{
    
	public function create(Request $data) {
		if (AppUser::where('email', strtolower($data->email))->active()->count() > 0) {
			return response()->json([
				'success' => false,
				'error' => 'Email is already in use.'
			], 200);
		} else {
			$user = new AppUser;
			$user->first_name = $data->first_name;
			$user->last_name = $data->last_name;
			$user->email = strtolower($data->email);
			$user->password = Hash::make($data->password);
			$user->save();

			return response()->json([
				'success' => true,
				'user_id' => $user->id
			], 200);
		}
	}

	public function login(Request $data) {
		if (AppUser::where('email', strtolower($data->email))->active()->count() > 0) {
			$user = AppUser::where('email', strtolower($data->email))->active()->first();
			if (Hash::check($user->password, $data->password) == true) {
				return response()->json([
					'success' => true,
					'user_id' => $user->id
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
		$user = AppUser::find($data->user_id);

		if (isset($data->first_name)) {
			$user->first_name = $data->first_name;
		}
		
		if (isset($data->last_name)) {
			$user->last_name = $data->last_name;
		}

		if (isset($data->points)) {
			$user->points = $data->points;
		}

		$user->save();

		return response()->json([
			'success' => true,
			'user' => $user->toArray()
		], 200);
	}

	public function delete(Request $data) {
		$user = AppUser::find($data->user_id);
		$user->is_active = 0;
		$user->save();
	}

}

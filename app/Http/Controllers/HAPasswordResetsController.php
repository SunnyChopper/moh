<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\HAPasswordReset;

use Illuminate\Http\Request;

class HAPasswordResetsController extends Controller
{
	
	/* --------------------- *\
		CRUD Functions
	\* --------------------- */

	public function create(Request $data) {
		$reset = new HAPasswordReset;
		$reset->user_id = $data->user_id;
		$reset->token = generateRandomString(16);
		$reset->expires_at = Carbon::now()->addHour();
		$reset->save();

		return response()->json(true, 200);
	}

	public function read() {
		return response()->json(HAPasswordReset::find($_GET['reset_id'])->toArray(), 200);
	}

	public function update(Request $data) {
		$reset = HAPasswordReset::find($data->reset_id);
		$reset->status = $data->status;
		$reset->save();

		return response()->json(true, 200);
	}

	/* --------------------- *\
		Helper Functions
	\* --------------------- */

	function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

}

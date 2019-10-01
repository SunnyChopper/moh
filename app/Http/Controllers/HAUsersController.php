<?php

namespace App\Http\Controllers;

use App\HAUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HAUsersController extends Controller
{
    
	/* --------------------- *\
        CRUD Functions
    \* --------------------- */

    public function create(Request $data) {
    	$user = new HAUser;
    	$user->username = $data->username;
    	$user->email = $data->email;
    	$user->password = Hash::make($data->password);
    	$user->profile_picture_url = $data->profile_picture_url;
    	$user->save();

    	return response()->json(true, 200);
    }

    public function read() {
    	return response()->json(HAUser::find($_GET['user_id'])->toArray(), 200);
    }

    public function update(Request $data) {
    	$user = HAUser::find($data->user_id);
    	$user->username = $data->username;
    	$user->email = $data->email;
    	$user->profile_picture_url = $data->profile_picture_url;
    	$user->save();

    	return response()->json(true, 200);
    }

    public function delete(Request $data) {
    	$user = HAUser::find($data->user_id);
    	$user->is_active = 0;
    	$user->save();

    	return response()->json(true, 200);
    }

}

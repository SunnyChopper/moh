<?php

use App\User;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/username/check', function(Request $data) {
	if (User::where('username', strtolower($data->username))->count() > 0) {
		return response()->json(true, 200);
	} else {
		return response()->json(false, 200);
	}
});


Route::post('/email/check', function(Request $data) {
	if (User::where('email', strtolower($data->email))->count() > 0) {
		return response()->json(true, 200);
	} else {
		return response()->json(false, 200);
	}
});
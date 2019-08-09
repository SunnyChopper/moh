<?php

use App\User;
use App\FreeConsultation;

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

Route::get('/consultations/view', function() {
	$consultation = FreeConsultation::find($_GET['consultation_id']);
	$return_array = array(
		"id" => $consultation->id,
		"first_name" => $consultation->first_name,
		"last_name" => $consultation->last_name,
		"skype_id" => $consultation->skype_id,
		"sa_percentage" => $consultation->sa_percentage,
		"f_percentage" => $consultation->f_percentage,
		"sd_percentage" => $consultation->sd_percentage,
		"ha_percentage" => $consultation->ha_percentage,
		"he_percentage" => $consultation->he_percentage,
		"sf_percentage" => $consultation->sf_percentage
	);

	return response()->json($return_array, 200);
});

Route::post('/account/create', 'MentorsController@create_trial_account');
Route::post('/personal-coaching/trial/enroll', 'MentorsController@enroll_trial');

// Course functions
Route::post('/courses/enroll', 'CoursesController@enroll');

// User functions
Route::post('/users/login', 'MembersController@attempt_login');
Route::post('/users/create', 'MembersController@attempt_register');

// Book club functions
Route::get('/book-club/members', 'BookClubMembershipsController@get_members');
Route::post('/book-club/payment', 'PaymentsController@book_club');
Route::post('/book-club/enroll', 'BookClubMembershipsController@create');

// Book club book functions
Route::get('/book-club/book/notes', 'BookClubController@get_notes');
Route::post('/book-club/book/notes/update', 'BookNotesController@update');

// Book club polls
Route::get('/book-club/polls', 'BookPollsController@get_polls');
Route::post('/book-club/polls/create', 'BookPollsController@create');
Route::post('/book-club/polls/update', 'BookPollsController@update');
Route::post('/book-club/polls/delete', 'BookPollsController@delete');
Route::get('/book-club/polls/results', 'BookPollsController@get_results');
Route::post('/book-club/polls/submit', 'BookVotesController@create');
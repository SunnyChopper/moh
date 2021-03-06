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

// Personal coaching functions
Route::post('/personal-coaching/trial/enroll', 'MentorsController@enroll_trial');
Route::post('/personal-coaching/application/submit', 'MentorsController@submit_application');
Route::get('/personal-coaching/applications', 'MentorsController@get_applications');
Route::post('/personal-coaching/applications/update', 'MentorsController@update_application');

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

// Book club link functions
Route::post('/book-club/links/create', 'BookLinksController@create');

// Lead functions
Route::get('/leads/email/check', 'LeadsController@email_check');
Route::post('/leads/submit', 'LeadsController@create');

Route::prefix('app-users')->group(function() {
	Route::post('create', 'AppUsersController@create');
	Route::get('read', 'AppUsersController@read');
	Route::post('login', 'AppUsersController@login');
	Route::post('update', 'AppUsersController@update');
	Route::post('delete', 'AppUsersController@delete');
	Route::get('get-points', 'AppUsersController@getUserPoints');
});

Route::prefix('app-habits')->group(function() {
	Route::post('create', 'AppHabitsController@create');
	Route::get('read', 'AppHabitsController@read');
	Route::post('update', 'AppHabitsController@update');
	Route::post('delete', 'AppHabitsController@delete');
	Route::get('get-for-user', 'AppHabitsController@getForUser');
	Route::post('mark-complete', 'AppHabitsController@markComplete');
});

Route::prefix('app-habit-levels')->group(function() {
	Route::post('create', 'AppHabitLevelsController@create');
	Route::get('read', 'AppHabitLevelsController@read');
	Route::post('update', 'AppHabitLevelsController@update');
	Route::post('delete', 'AppHabitLevelsController@delete');
	Route::get('get-for-user', 'AppHabitLevelsController@getForUser');
	Route::get('get-for-habit', 'AppHabitLevelsController@getForHabit');
});

Route::prefix('app-habit-logs')->group(function() {
	Route::post('create', 'AppHabitLogsController@create');
	Route::post('delete', 'AppHabitLogsController@delete');
	Route::get('get-for-user', 'AppHabitLogsController@getForUser');
	Route::get('get-for-habit', 'AppHabitLogsController@getForHabit');
	Route::get('get-for-level', 'AppHabitLogsController@getForLevel');
});

Route::prefix('app-rewards')->group(function() {
	Route::post('create', 'AppRewardsController@create');
	Route::get('read', 'AppRewardsController@read');
	Route::post('redeem', 'AppRewardsController@redeem');
	Route::post('update', 'AppRewardsController@update');
	Route::post('delete', 'AppRewardsController@delete');
	Route::get('get-for-user', 'AppRewardsController@getForUser');
});

Route::prefix('app-blogs')->group(function() {
	Route::get('get-recent', 'BlogPostsController@getRecent');
});
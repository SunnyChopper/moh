<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\MentorApplication;
use App\MentorRecommendation;
use App\MentorMessage;
use App\MentorAppointment;
use App\MentorVideo;
use App\MentorDocument;
use App\MentorTask;
use App\MentorEnrollment;
use App\User;
use App\Custom\AdminHelper;
use App\Custom\MentorHelper;
use App\Custom\StripeHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MentorsController extends Controller
{

	public function enroll(Request $data) {
		// Step 1: Get user profile
		if (Auth::guest()) {
			// Create the user
			$user = new User;
			$user->first_name = $data->first_name;
			$user->last_name = $data->last_name;
			$user->username = $data->username;
			$user->email = strtolower($data->email);
			$user->password = Hash::make($data->password);
			$user->save();
			Auth::loginUsingId($user->id);
		} else {
			$user = User::find(Auth::id());
		}

		// Step 2: Make subscription payment
		if (intval($data->special_link) == 1) {
			$data = array(
				'plan_id' => 'monthly-discounted',
				'email' => $data->email,
				'card_number' => $data->card_number,
				'cvvNumber' => $data->cvvNumber,
				'ccExpiryMonth' => $data->ccExpiryMonth,
				'ccExpiryYear' => $data->ccExpiryYear
			);
		} else {
			$data = array(
				'plan_id' => 'monthly',
				'email' => $data->email,
				'card_number' => $data->card_number,
				'cvvNumber' => $data->cvvNumber,
				'ccExpiryMonth' => $data->ccExpiryMonth,
				'ccExpiryYear' => $data->ccExpiryYear
			);
		}

		$response = StripeHelper::subscribe($data);

		if ($response == "error") {
			return redirect()->back()->with('error', 'There was an error while processing your information.');
		} else {
			// Create enrollment
			$enrollment = new MentorEnrollment;
			$enrollment->user_id = $user->id;
			$enrollment->customer_id = $response[0];
			$enrollment->subscription_id = $response[1];
			$enrollment->next_payment_date = Carbon::today()->addMonth();
			$enrollment->trial = 0;
			$enrollment->save();

			// Redirect to personal coaching dashboard
			return redirect(url('/members/personal-coaching'));
		}
	}

	public function create_trial_account(Request $data) {
		$user = new User;
		$user->email = $data->email;
		$user->password = Hash::make($data->password);
		$user->first_name = $data->first_name;
		$user->last_name = $data->last_name;
		$user->username = strtolower($data->username);
		$user->source = "QUIZ";
		$user->save();

		Auth::login($user);

		return response()->json($user->id, 200);
	}

	public function enroll_trial(Request $data) {
		// Create Stripe trial product
		$stripe_data = array(
			'plan_id' => 'trial',
			'user_id' => $data->user_id,
			'email' => $data->email,
			'card_number' => $data->card_number,
			'cvvNumber' => $data->cvvNumber,
			'ccExpiryMonth' => $data->ccExpiryMonth,
			'ccExpiryYear' => $data->ccExpiryYear
		);

		$response = StripeHelper::subscribe($stripe_data);

		if ($response == "error") {
			return response()->json(false, 200);
		} else {
			// Create enrollment
			$enrollment = new MentorEnrollment;
			$enrollment->user_id = $data->user_id;
			$user = User::find(intval($data->user_id));
			$user->customer_id = $response["customer_id"];
			$user->card_id = $response["card_id"];
			$user->save();
			$enrollment->customer_id = $response["customer_id"];
			$enrollment->subscription_id = $response["subscription_id"];
			$enrollment->next_payment_date = Carbon::today()->addDays(7);
			$enrollment->trial = 1;

			if(isset($data->sa_score)) {
				$enrollment->sa_score = $data->sa_score;
				$enrollment->f_score = $data->f_score;
				$enrollment->sd_score = $data->sd_score;
				$enrollment->ha_score = $data->ha_score;
				$enrollment->he_score = $data->he_score;
				$enrollment->sf_score = $data->sf_score;
			}

			$enrollment->save();

			// Redirect to personal coaching dashboard
			return response()->json(true, 200);
		}
	}

	public function personal_coaching() {
		if ($this->isUserAuthorized() == false) {
			return redirect(url('/personal-coaching'));
		}

		$member = Auth::user();
		$appointments = MentorHelper::getFutureAppointmentsForUser($member->id);
		$documents = MentorDocument::where('user_id', $member->id)->get();
		$recommendations = MentorRecommendation::where('user_id', $member->id)->get();
		$tasks = MentorTask::where('user_id', $member->id)->get();
		$videos = MentorVideo::where('user_id', $member->id)->get();

		$page_title = "Your Mentorship Dashboard";
		$page_header = $page_title;

		return view('members.mentors.dashboard')->with('page_title', $page_title)->with('page_header', $page_header)->with('member', $member)->with('documents', $documents)->with('recommendations', $recommendations)->with('tasks', $tasks)->with('videos', $videos)->with('appointments', $appointments);
	}

	public function submit_application(Request $data) {
		$app = new MentorApplication;
		$app->first_name = $data->first_name;
		$app->last_name = $data->last_name;
		$app->email = $data->email;
		$app->phone = $data->phone;
		$app->timezone = $data->timezone;
		$app->call_time = $data->call_time;
		$app->years = $data->years;
		$app->determination_score = $data->determination_score;
		$app->strengths = $data->strengths;
		$app->weaknesses = $data->weaknesses;
		$app->why = $data->why;
		$app->purpose = $data->purpose;
		$app->save();

		return response()->json(true, 200);
	}

	public function admin_view_applications() {
		if (AdminHelper::isAuthorized() == false) {
			return redirect(url('/admin'));
		}

		$page_title = "View Personal Coaching Applications";
		$page_header = "Applications";

		return view('admin.personal-coaching.applications.view')->with('page_title', $page_title)->with('page_header', $page_header);
	}

	public function get_applications() {
		return response()->json(MentorApplication::active()->get()->toArray(), 200);
	}

	public function update_application(Request $data) {
		$application = MentorApplication::find($data->application_id);
		$application->status = $data->status;
		$application->save();

		return response()->json(true, 200);
	}

	public function edit_task($task_id) {
		if ($this->isUserAuthorized() == false) {
			return redirect(url('/personal-coaching'));
		}

		$member = Auth::user();
		$task = MentorTask::find($task_id);

		$page_title = "Edit " . $task->title;
		$page_header = $page_title;

		return view('members.mentors.tasks.edit')->with('member', $member)->with('task', $task)->with('page_title', $page_title)->with('page_header', $page_header);
	}

	public function update_task(Request $data) {
		$task = MentorTask::find($data->task_id);
		$task->status = $data->status;
		$task->save();

		return redirect(url('/members/personal-coaching'));
	}

	public function read_mentor_recommendation($r_id) {
		$r = MentorRecommendation::find($r_id);
		$page_title = $r->title;
		$page_header = $page_title;
		return view('members.mentors.recommendations.view')->with('recommendation', $r)->with('page_title', $page_title)->with('page_header', $page_header);
	}

	public function update_mentor_recommendation(Request $data) {
		$r = MentorRecommendation::find($data->r_id);
		$r->user_id = $data->user_id;
		$r->title = $data->title;
		$r->description = $data->description;
		$r->link = $data->link;
		$r->type = $data->type;
		$r->save();

		return redirect(url('/admin/mentors/recommendations'));
	}

	public function delete_mentor_recommendation(Request $data) {
		$r = MentorRecommendation::find($data->r_id);
		$r->is_active = 0;
		$r->save();

		return redirect(url('/admin/mentors/recommendations'));
	}

	public function create_mentor_message(Request $data) {
		$m = new MentorMessage;
		$m->user_id = $data->user_id;
		$m->reception_status = $data->reception_status;
		$m->message = $data->message;
		$m->save();

		// TODO: Redirect based on admin or not
	}

	public function create_mentor_appointment(Request $data) {
		$a = new MentorAppointment;
		$a->appointment_date = $data->appointment_date;
		$a->appointment_time = $data->appointment_time;
		$a->timezone = $data->timezone;
		$a->save();

		return redirect(url('/admin/mentors/appointments'));
	}

	public function update_mentor_appointment(Request $data) {
		$a = MentorAppointment::find($data->a_id);
		$a->user_id = $data->user_id;
		$a->appointment_date = $data->appointment_date;
		$a->appointment_time = $data->appointment_time;
		$a->timezone = $data->timezone;
		$a->save();

		// TODO: Redirect based on admin or not
	}

	public function delete_mentor_appointment(Request $data) {
		$a = MentorAppointment::find($data->a_id);
		// TODO: Check to see if user was booking it and send them an update email if needed
		$a->is_active = 0;
		$a->save();

		return redirect(url('/admin/mentors/appointments'));
	}

	public function create_mentor_video(Request $data) {
		$v = new MentorVideo;
		$v->user_id = $data->user_id;
		$v->title = $data->title;
		$v->description = $data->description;
		$v->video_id = $data->video_id;
		$v->save();

		return redirect(url('/admin/mentors/videos'));
	}

	public function read_mentor_video($video_id) {
		$v = MentorVideo::find($video_id);
		$page_title = $v->title;
		$page_header = $page_title;
		return view('members.mentors.videos.view')->with('video', $v)->with('page_title', $page_title)->with('page_header', $page_header);
	}

	public function update_mentor_video(Request $data) {
		$v = MentorVideo::find($data->v_id);
		$v->title = $data->title;
		$v->description = $data->description;
		$v->video_id = $data->video_id;
		$v->save();

		return redirect(url('/admin/mentors/videos'));
	}

	public function delete_mentor_video(Request $data) {
		$v = MentorVideo::find($data->v_id);
		$v->status = 0;
		$v->save();

		return redirect(url('/admin/mentors/videos'));
	}

	public function create_mentor_document(Request $data) {
		$doc = new MentorDocument;
		$doc->user_id = $data->user_id;
		$doc->title = $data->title;
		$doc->description = $data->description;
		$doc->link = $data->link;
		$doc->save();

		return redirect(url('/admin/mentors/documents'));
	}

	public function update_mentor_document(Request $data) {
		$doc = MentorDocument::find($data->d_id);
		$doc->user_id = $data->user_id;
		$doc->title = $data->title;
		$doc->description = $data->description;
		$doc->link = $data->link;
		$doc->save();

		return redirect(url('/admin/mentors/documents'));
	}

	public function delete_mentor_document(Request $data) {
		$doc = MentorDocument::find($data->d_id);
		$doc->status = 0;
		$doc->save();

		return redirect(url('/admin/mentors/documents'));
	}

	public function create_mentor_task(Request $data) {
		$task = new MentorTask;
		$task->user_id = $data->user_id;
		$task->title = $data->title;
		$task->description = $data->description;
		$task->due_date = $data->due_date;
		$task->save();

		// TODO: Send an email to the user

		return redirect(url('/admin/mentors/tasks'));
	}

	public function read_mentor_task($task_id) {
		$task = MentorTask::find($task_id);
		$page_title = $task->title;
		$page_header = $page_title;
		return view('members.mentors.tasks.view')->with('task', $task)->with('page_title', $page_title)->with('page_header', $page_header);
	}

	public function update_mentor_task(Request $data) {
		$task = MentorTask::find($data->task_id);
		$task->user_id = $data->user_id;
		$task->title = $data->title;
		$task->description = $data->description;
		$task->due_date = $data->due_date;
		$task->save();

		// TODO: Send an email to the user

		return redirect(url('/admin/mentors/tasks'));
	}

	public function delete_mentor_task(Request $data) {
		$task = MentorTask::find($data->task_id);
		$task->status = 0;
		$task->save();

		return redirect(url('/admin/mentors/tasks'));
	}

	public function create_mentor_enrollment(Request $data) {
		$enrollment = new MentorEnrollment;
		$enrollment->user_id = Auth::id();
		// TODO: Function to get Stripe charge
		$enrollment->next_payment_date = Carbon::now()->addMonth();
		$enrollment->save();

		return redirect(url('/members/mentors/dashboard'));
	}

	public function read_mentor_enrollment($e_id) {
		$enrollment = MentorEnrollment::find($e_id);
		$page_title = "Mentor Enrollment";
		$page_header = $page_title;
		return view('members.enrollments.view')->with('enrollment', $enrollment)->with('page_title', $page_title)->with('page_header', $page_header);
	}

	public function update_mentor_enrollment(Request $data) {
		$enrollment = MentorEnrollment::find($data->e_id);
		$enrollment->next_payment_date = $data->next_payment_date;
		$enrollment->status = $data->status;
		$enrollment->save();

		// TODO: Redirect based on status
		return redirect(url('/members/mentors/dashboard'));
	}

	public function delete_mentor_enrollment(Request $data) {
		$enrollment = MentorEnrollment::find($data->e_id);
		$enrollment->status = 0;
		$enrollment->save();

		return redirect(url('/members/dashboard'));
	}

	public function view_open_appointments() {
		$page_title = "Under Construction";
		$page_header = $page_title;

		return view('members.mentors.appointments.view')->with('page_header', $page_header)->with('page_title', $page_title);
	}

	private function isUserAuthorized() {
		if (MentorEnrollment::where('user_id', Auth::id())->count() > 0) {
			return true;
		} else {
			return false;
		}
	}
}

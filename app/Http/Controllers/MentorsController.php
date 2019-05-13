<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\MentorRecommendation;
use App\MentorMessage;
use App\MentorAppointment;
use App\MentorVideo;
use App\MentorDocument;
use App\MentorTask;
use App\MentorEnrollment;
use Illuminate\Http\Request;

class MentorsController extends Controller
{
	public function create_mentor_recommendation(Request $data) {
		$r = new MentorRecommendation;
		$r->user_id = $data->user_id;
		$r->title = $data->title;
		$r->description = $data->description;
		$r->link = $data->link;
		$r->type = $data->type;
		$r->save();

		return redirect(url('/admin/mentors/recommendations'));
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
}

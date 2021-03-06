<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Course;
use App\BookVote;
use App\BookPoll;
use App\BookClubBook;
use App\CourseMembership;
use App\MentorEnrollment;
use App\BookClubMembership;

use App\Custom\SubscriptionsHelper;
use App\Custom\StudentPlannerHelper;
use App\Custom\BookClubHelper;
use App\Custom\PomodoroHelper;
use App\Custom\MailHelper;
use App\Custom\UserHelper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MembersController extends Controller
{

	public function dashboard() {
		if ($this->isAuthorized() == false) {
			return redirect(url('/login?redirect_action=/members/dashboard'));
		}

		$page_title = "Members Dashboard";
		$page_header = $page_title;

		$courses = Course::where('is_active', 1)->get();

		$session_stats = PomodoroHelper::getStatsForUser(Auth::id());

		$student_tasks = StudentPlannerHelper::getTasksForUser(Auth::id());

		if (MentorEnrollment::where('user_id', Auth::id())->count() > 0) {
			$is_enrolled = true;
		} else {
			$is_enrolled = false;
		}

		return view('members.dashboard')->with('page_title', $page_title)->with('page_header', $page_header)->with('is_enrolled', $is_enrolled)->with('courses', $courses)->with('session_stats', $session_stats)->with('student_tasks', $student_tasks);
	}

	public function attempt_login(Request $data) {
		if (User::where('username', strtolower($data->username))->count() > 0) {
			$user = User::where('username', strtolower($data->username))->first();
			if (Hash::check($data->password, $user->password) == true) {
				Auth::login($user);
				return response()->json(1, 200);
			} else {
				return response()->json(0, 200);
			}
		} else {
			return response()->json(-1, 200);
		}
	}

	public function attempt_register(Request $data) {
		$user = new User;
		$user->email = $data->email;
		$user->username = $data->username;
		$user->password = Hash::make($data->password);

		if (isset($data->first_name)) {
			$user->first_name = $data->first_name;
		}

		if (isset($data->last_name)) {
			$user->first_name = $data->last_name;
		}

		$user->save();

		Auth::login($user);

		return response()->json($user->id, 200);
	}

	public function enroll_course($course_id) {
		if ($this->isAuthorized() == false) {
			return redirect(url('/login?redirect_action=/members/dashboard'));
		}

		// Get course information
		$course = Course::find($course_id);

		// Check if it's free. Just create the membership and redirect to dashboard.
		if ($course->price == 0) {
			if (CourseMembership::where('user_id', Auth::id())->where('course_id', $course_id)->count() > 0) {
				return redirect(url('/members/courses/' . $course_id . '/dashboard'));
			} else {
				$membership = new CourseMembership;
				$membership->user_id = Auth::id();
				$membership->course_id = $course_id;
				$membership->save();

				return redirect(url('/members/courses/' . $course_id . '/dashboard'));
			}
		}
	}

	public function client_dashboard_book_club() {
		if ($this->isAuthorized() == false) {
			return redirect(url('/login?redirect_action=/members/book-club'));
		}

		if (BookClubHelper::isUserAuthorized(Auth::id()) == false) {
			return redirect(url('/book-club'));
		}

		if (BookClubHelper::checkStripeMembership(Auth::id()) == false) {
			return redirect(url('/members/subscriptions/expired'));
		}

		$page_title = "Book Club Dashboard";
		$page_header = $page_title;

		$active_book = BookClubBook::current()->first();
		$books = BookClubBook::active()->get();
		$active_poll = BookPoll::current()->first();
		$user_vote = BookVote::where('user_id', Auth::id())->where('poll_id', $active_poll->id)->first();

		return view('members.book-club.dashboard')->with('page_title', $page_title)->with('page_header', $page_header)->with('active_book', $active_book)->with('books', $books)->with('active_poll', $active_poll)->with('user_vote', $user_vote);
	}

	public function subscriptions() {
		if ($this->isAuthorized() == false) {
			return redirect(url('/login?redirect_action=/members/subscriptions'));
		}

		$page_title = "Your Subscriptions";
		$page_header = $page_title;

		$subscriptions = SubscriptionsHelper::getSubscriptions(Auth::id());

		return view('members.subscriptions')->with('page_title', $page_title)->with('page_header', $page_header)->with('subscriptions', $subscriptions);
	}

	public function logout() {
		UserHelper::logout();
		return redirect(url('/'));
	}

    private function isAuthorized() {
    	if (Auth::guest()) {
    		return false;
    	} else {
    		return true;
    	}
    }

}

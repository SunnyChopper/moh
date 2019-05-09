<?php

namespace App\Http\Controllers;

use Auth;
use App\Course;
use App\CourseMembership;
use App\Custom\UserHelper;
use Illuminate\Http\Request;

class MembersController extends Controller
{

	public function dashboard() {
		if ($this->isAuthorized() == false) {
			return redirect(url('/login?redirect_action=/members/dashboard'));
		}

		$page_title = "Members Dashboard";
		$page_header = $page_title;

		return view('members.dashboard')->with('page_title', $page_title)->with('page_header', $page_header);
	}

	public function enroll_course($course_id) {
		if ($this->isAuthorized() == false) {
			return redirect(url('/login?redirect_action=/members/dashboard'));
		}

		$course = Course::find($course_id);
		if ($course->price == 0) {
			$membership = new CourseMembership;
			$membership->user_id = Auth::id();
			$membership->course_id = $course_id;
			$membership->save();

			return redirect(url('/'));
		}
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

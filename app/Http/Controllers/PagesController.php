<?php

namespace App\Http\Controllers;

use Auth;

use App\Course;
use App\CourseModule;
use App\CourseMembership;
use App\FreeConsultation;
use App\BookClubMembership;

use App\Custom\CourseHelper;
use App\Custom\BlogPostHelper;
use App\Custom\PomodoroHelper;
use App\Custom\StripeHelper;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

class PagesController extends Controller
{

    public function test(Request $data) {
        return response()->json([
            'challenge' => $data->challenge
        ], 200);
    }

    public function index() {
    	$page_title = "Welcome";

        $posts = BlogPostHelper::get_recent();

    	return view('pages.index')->with('page_title', $page_title)->with('posts', $posts);
    }

    public function courses() {
    	$page_title = "Courses";
    	$page_header = $page_title;

    	$courses = CourseHelper::viewCourses();

    	return view('pages.courses')->with('page_title', $page_title)->with('page_header', $page_header)->with('courses', $courses);
    }

    public function view_course($course_id) {
        // Check to see if already enrolled
        if (Auth::guest() == false) {
            if (CourseMembership::where('user_id', Auth::id())->where('course_id', $course_id)->count() > 0) {
                return redirect(url('/members/courses/' . $course_id . '/dashboard'));
            }
        }

    	$course = Course::find($course_id);

    	$page_title = $course->title;
    	$page_header = $page_title;

        $course_modules = CourseModule::where('course_id', $course->id)->get();

    	return view('pages.view-course')->with('page_title', $page_title)->with('page_header', $page_header)->with('course', $course)->with('modules', $course_modules);
    }

    public function personal_coaching() {
        $page_title = "Personal Coaching";
        $page_header = $page_title;

        $special_link = false;
        $expired_link = true;
        if (isset($_GET['exl'])) {
            $special_link = true;
            $encrypted = $_GET['exl'];
            $expiration = Crypt::decrypt($encrypted);

            if (Carbon::now()->gt(Carbon::parse($expiration))) {
                $expired_link = true;
            } else {
                $expired_link = false;
            }
        }

        return view('pages.personal-coaching')->with('page_title', $page_title)->with('page_header', $page_header)->with('special_link', $special_link)->with('expired_link', $expired_link);
    }

    public function self_dev_quiz() {
        $page_title = "Self-Development Quiz";
        $page_header = $page_title;

        return view('pages.self-dev-quiz')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function tools() {
        $page_title = "Tools";
        $page_header = $page_title;

        return view('pages.tools')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function pomodoro() {
        $page_title = "Pomodoro Tool";
        $page_header = $page_title;

        $sessions = PomodoroHelper::getNumberOfSessions();

        return view('pages.pomodoro')->with('page_title', $page_title)->with('page_header', $page_header)->with('sessions', $sessions);
    }

    public function student_planner() {
        $page_title = "Student Planner Tool";
        $page_header = $page_title;

        return view('pages.student-planner')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function rice_planner() {
        $page_title = "RICE Planner Tool";
        $page_header = $page_title;

        return view('pages.rice-planner')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function focus_cheatsheet() {
        $page_title = "Ultimate Focus Cheatsheet";
        $page_header = $page_title;

        $landing_page_footer_text = "Want to know what both Warren Buffett and Bill Gates thought was the most important character trait for success? It was focus. If you do not have the ability to sit down and focus on a task or even focus on a single mission, it won't matter how much effort you try to exert, you will not be able to move the needle. With self-development and practice, you can build your focus muscle and attain laser focus.";

        return view('landing-pages.focus-cheatsheet')->with('page_title', $page_title)->with('page_header', $page_header)->with('landing_page_footer_text', $landing_page_footer_text);
    }

    public function book_club() {
        if (!Auth::guest()) {
            if (BookClubMembership::where('user_id', Auth::id())->where('status', 1)->count() > 0) {
                return redirect(url('/members/book-club'));
            }
        }

        $page_title = "Mind of Habit Book Club";
        $page_header = $page_title;
        $page_description = "Finally unlock your inner confidence and purpose with the Mind of Habit Book Club.";
        $page_image = asset('img/book-club.png');

        $landing_page_footer_text = "We want to help accelerate your self-development growth. We want to make sure you get to state of mind where you're finding a deeper purpose and happiness in what you do. You only get one shot at life so why not become the best version of yourself and tap into your deeper inner purpose and happiness.";

        $seo_array = array(
            "description" => $page_description,
            "og:title" => $page_title,
            "og:type" => "website",
            "og:url" => "https://www.mindofhabit.com/mastermind",
            "og:image" => $page_image,
            "og:image:alt" => "Mind of Habit Book Club",
            "og:description" => $page_description,
            "twitter:card" => "summary_large_image"
        );

        return view('landing-pages.book-club')->with('page_title', $page_title)->with('page_header', $page_header)->with('landing_page_footer_text', $landing_page_footer_text)->with('seo_array', $seo_array);
    }

    public function habit_tracker() {
        $page_title = "Habit Tracker App";
        $page_header = $page_title;
        $page_description = "Get rid of those bad habits that you've been meaning to for a while now. Build the good habits you need to succeed.";
        $page_image = asset('img/habit-tracker.png');

        $landing_page_footer_text = "Start to get rid of those annoying bad habits you've been meaning to. We'll help you with each step in the process of systematically breaking down a bad habit. We'll make it darn easy to get rid of a bad habit. After your bad habits are destroyed, we'll help you create good ones. We will also walk you through a system to help you generate good habits.";

        $seo_array = array(
            "description" => $page_description,
            "og:title" => $page_title,
            "og:type" => "website",
            "og:url" => "https://www.mindofhabit.com/habit-tracker",
            "og:image" => $page_image,
            "og:image:alt" => "Mind of Habit Habit Tracker App",
            "og:description" => $page_description,
            "twitter:card" => "summary_large_image"
        );

        return view('landing-pages.habit-tracker')->with('page_title', $page_title)->with('page_header', $page_header)->with('landing_page_footer_text', $landing_page_footer_text)->with('seo_array', $seo_array);
    }

    public function submit_free_consultation(Request $data) {
        $name_array = $this->split_name($data->name);

        $consultation = new FreeConsultation;
        $consultation->first_name = $name_array[0];
        $consultation->last_name = $name_array[1];
        $consultation->skype_id = $data->skype_id;
        $consultation->sa_percentage = $data->sa_percentage;
        $consultation->f_percentage = $data->f_percentage;
        $consultation->sd_percentage = $data->sd_percentage;
        $consultation->ha_percentage = $data->ha_percentage;
        $consultation->he_percentage = $data->he_percentage;
        $consultation->sf_percentage = $data->sf_percentage;
        $consultation->timezone = $data->timezone;
        $consultation->app = $data->app;
        $consultation->contact = $data->contact;
        $consultation->meeting_date = $data->meeting_date;
        $consultation->meeting_time = $data->meeting_time;
        $consultation->save();

        return redirect(url('/consultation/thank-you'));
    }

    public function thank_you_consultation() {
        $page_title = "You're Registered";
        $page_header = $page_title;

        return view('pages.thank-you-consultation')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    private function split_name($name) {
        $name = trim($name);
        $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim( preg_replace('#'.$last_name.'#', '', $name ) );
        return array($first_name, $last_name);
    }
}

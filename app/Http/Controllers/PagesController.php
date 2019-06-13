<?php

namespace App\Http\Controllers;

use App\Course;
use App\FreeConsultation;

use App\Custom\CourseHelper;
use App\Custom\BlogPostHelper;
use App\Custom\PomodoroHelper;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

class PagesController extends Controller
{

    public function test() {
        // Start by creating a charge
        $stripe = Stripe::make(env('STRIPE_SECRET'));
        $plan = $stripe->plans()->find('personal-coaching');
        return var_dump($plan);
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
    	$course = Course::find($course_id);

    	$page_title = $course->title;
    	$page_header = $page_title;

    	return view('pages.view-course')->with('page_title', $page_title)->with('page_header', $page_header)->with('course', $course);
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

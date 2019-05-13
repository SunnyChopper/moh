<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\DirectQuestion;
use App\DirectQuestionEnrollment;
use Illuminate\Http\Request;

class DirectQuestionsController extends Controller
{
    public function create_direct_question(Request $data) {
    	$question = new DirectQuestion;
    	$question->user_id = $data->user_id;
    	$question->title = $data->title;
    	$question->description = $data->description;
    	$question->save();

    	return redierct(url('/members/questions'));
    }

    public function read_direct_question($question_id) {
    	$question = DirectQuestion::find($question_id);
    	$page_title = $question->title;
    	$page_header = $page_title;
    	return view('members.questions.view')->with('question', $question)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update_direct_question(Request $data) {
    	$question = DirectQuestion::find($data->question_id);
    	$question->title = $data->title;
    	$question->description = $data->description;
    	$question->save();

		return redierct(url('/members/questions'));
    }

    public function delete_direct_question(Request $data) {
    	$question = DirectQuestion::find($data->question_id);
    	$question->status = 0;
    	$question->save();

    	return redierct(url('/members/questions'));
    }

    public function create_direct_question_enrollment(Request $data) {
    	$enrollment = new DirectQuestionEnrollment;
    	// TODO: Function to charge customer based on plan
    	$enrollment->plan_id = $data->plan_id;
    	$enrollment->next_payment_date = Carbon::now()->addMonth();
    	$enrollment->save();

    	return redierct(url('/members/questions'));
    }

    public function read_direct_question_enrollment($e_id) {
    	$enrollment = DirectQuestionEnrollment::find($e_id);
    	$page_title = "Direct Questions Enrollment";
    	$page_header = $page_title;
    	return view('members.enrollments.view')->with('enrollment', $enrollment)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update_direct_question_enrollment(Request $data) {
    	$enrollment = DirectQuestionEnrollment::find($data->e_id);
    	$enrollment->next_payment_date = $data->next_payment_date;
    	$enrollment->status = $data->status;
    	$enrollment->save();

    	return redierct(url('/members/enrollments'));
    }

    public function delete_direct_question_enrollment(Request $data) {
    	$enrollment = DirectQuestionEnrollment::find($data->e_id);
    	$enrollment->status = 0;
    	$enrollment->save();

    	return redierct(url('/members/enrollments'));
    }
}

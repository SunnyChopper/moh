<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseReview;

class CourseReviewsController extends Controller
{
    public function create(Request $data) {
    	$review = new CourseReview;
    	$review->user_id = $data->user_id;
    	$review->course_id = $data->course_id;
    	$review->rating = $data->rating;
    	$review->title = $data->title;
    	$review->description = $data->description;
    	$review->save();

    	return $review->id;
    }

    public function read($review_id) {
    	$review = CourseReview::find($review_id);
    	$page_title = $review->title;
    	$page_header = $page_title;
    	return view('pages.view-review')->with('review', $review)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update(Request $data) {
    	$review = CourseReview::find($data->review_id);
    	$review->title = $data->title;
    	$review->description = $data->description;
    	$review->save();

    	return true;
    }

    public function delete(Request $data) {
    	$review = CourseReview::find($data->review_id);
    	$review->is_active = 0;
    	$review->save();
    	return true;
    }
}

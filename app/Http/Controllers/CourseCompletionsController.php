<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseCompletion;

class CourseCompletionsController extends Controller
{
    public function create(Request $data) {
    	$completion = new CourseCompletion;
    	$completion->user_id = $data->user_id;
    	$completion->course_id = $data->course_id;
    	$completion->video_id = $data->video_id;
    	$completion->save();

    	return $completion->id;
    }
}

<?php

namespace App\Http\Controllers;

use Auth;

use App\Custom\CourseHelper;

use Illuminate\Http\Request;
use App\CourseCompletion;

class CourseCompletionsController extends Controller
{
    public function create($course_id, $video_id) {
    	// Create completion
    	$completion = new CourseCompletion;
    	$completion->user_id = Auth::id();
    	$completion->course_id = $course_id;
    	$completion->video_id = $video_id;
    	$completion->save();

    	// Get next video
    	$next_video = CourseHelper::getNextVideo($video_id);
    	if ($next_video != null) {
    		return redirect(url('/members/courses/' . $course_id . '/module/' . $next_video->module_id . '/watch/' . $next_video->id));
    	} else {
    		return redirect()->back();
    	}
    }
}

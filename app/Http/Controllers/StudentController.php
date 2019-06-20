<?php

namespace App\Http\Controllers;

use Auth;

use App\StudentClass;
use App\StudentTask;

use App\Custom\StudentPlannerHelper;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard() {
    	if (Auth::guest()) {
    		return redirect(url('/login?redirect_action=/members/student'));
    	}

    	$classes = StudentPlannerHelper::getClassesForUser(Auth::id());
    	$tasks = StudentPlannerHelper::getTasksForUser(Auth::id());

    	$page_title = "Student Planner";
    	$page_header = $page_title;

    	return view('members.student.dashboard')->with('tasks', $tasks)->with('classes', $classes)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function new_class() {
    	if (Auth::guest()) {
    		return redirect(url('/login?redirect_action=/members/student/class/new'));
    	}

    	$page_title = "Create New Class";
    	$page_header = $page_title;

    	return view('members.student.new-class')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function create_class(Request $data) {
    	$class = new StudentClass;
        $class->user_id = Auth::id();
    	$class->title = $data->title;
    	$class->description = $data->description;
    	$class->category = $data->category;
    	$class->save();

    	return redirect(url('/members/student'));
    }

    public function edit_class($class_id) {
    	if (Auth::guest()) {
    		return redirect(url('/login?redirect_action=/members/student/class/edit/' .  $class_id));
    	}

    	$class = StudentClass::find($class_id);

    	$page_title = "Edit " . $class->title;
    	$page_header = $page_title;

    	return view('members.student.edit-class')->with('class', $class)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update_class(Request $data) {
    	$class = StudentClass::find($data->class_id);
    	$class->title = $data->title;
    	$class->description = $data->description;
    	$class->category = $data->category;
    	$class->save();

    	return redirect(url('/members/student'));
    }

    public function delete_class(Request $data) {
    	$class = StudentClass::find($data->class_id);
    	$class->is_active = 0;
    	$class->save();

    	return response()->json(['success' => 'Successfully deleted class.'], 200);
    }

    public function new_task() {
    	if (Auth::guest()) {
    		return redirect(url('/login?redirect_action=/members/student/tasks/new'));
    	}

    	$classes = StudentPlannerHelper::getClassesForUser(Auth::id());

    	$page_title = "New Task";
    	$page_header = $page_title;

    	return view('members.student.new-task')->with('classes', $classes)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function create_task(Request $data) {
    	$task = new StudentTask;
    	$task->user_id = Auth::id();
    	$task->class_id = $data->class_id;
    	$task->title = $data->title;
    	$task->description = $data->description;
    	$task->grade_impact = $data->grade_impact;
    	$task->confidence = $data->confidence;
    	$task->ease = $data->ease;
    	$task->due_date = $data->due_date;
    	$task->category = $data->category;
    	$task->save();

    	return redirect(url('/members/student'));
    }

    public function edit_task($task_id) {
    	if (Auth::guest()) {
    		return redirect(url('/login?redirect_action=/members/student/tasks/edit/' . $task_id));
    	}

    	$task = StudentTask::find($task_id);
    	$classes = StudentPlannerHelper::getClassesForUser(Auth::id());

    	$page_title = "Edit " . $task->title;
    	$page_header = $page_title;

    	return view('members.student.edit')->with('task', $task)->with('classes', $classes)->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function update_task(Request $data) {
    	$task = StudentTask::find($data->task_id);
    	$task->class_id = $data->class_id;
    	$task->title = $data->title;
    	$task->description = $data->description;
    	$task->grade_impact = $data->grade_impact;
    	$task->confidence = $data->confidence;
    	$task->ease = $data->ease;
    	$task->due_date = $data->due_date;
    	$task->category = $data->category;
    	$task->save();

    	return redirect(url('/members/student'));
    }

    public function mark_complete(Request $data) {
        $task = StudentTask::find($data->task_id);
        $task->is_active = 2;
        $task->save();

        return response()->json(['success' => 'Task successfully updated.'], 200);
    }

    public function delete_task(Request $data) {
    	$task = StudentTask::find($data->task_id);
    	$task->is_active = 0;
    	$task->save();

    	return response()->json(['success' => 'Task successfully deleted.'], 200);
    }

}

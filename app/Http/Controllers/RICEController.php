<?php

namespace App\Http\Controllers;

use Auth;
use App\RICETask;
use App\RICEEnrollment;
use App\Custom\RICEHelper;
use Illuminate\Http\Request;

class RICEController extends Controller
{

	public function index() {
		if (RICEHelper::isAuth(Auth::id()) == false) {
    		return redirect(url('/members/rice/enroll'));
    	}

    	$tasks = RICEHelper::viewAllTasks(Auth::id());
    	$page_title = "Your RICE Tasks";

    	return view('members.rice.index')->with('tasks', $tasks)->with('page_title', $page_title);
	}

    public function newTask() {
    	if (RICEHelper::isAuth(Auth::id()) == false) {
    		return redirect(url('/members/rice/enroll'));
    	}

    	$page_title = "Create New RICE Task";

    	return view('members.rice.tasks.new')->with('page_title', $page_title);
    }

    public function createTask(Request $data) {
    	$task = new RICETask;
    	$task->user_id = Auth::id();
    	$task->title = $data->title;
    	$task->description = $data->description;
    	$task->reach = $data->reach;
    	$task->impact = $data->impact;
    	$task->confidence = $data->confidence;
    	$task->ease = $data->ease;
    	$task->score = (float)($data->reach + $data->impact + $data->confidence) / (float)$data->ease;
    	$task->status = 1;
    	$task->save();

    	return redirect(url('/members/rice/view/' . $task->id));
    }

    public function readTask($task_id) {
    	if (RICEHelper::isAuth(Auth::id()) == false) {
    		return redirect(url('/members/rice/enroll'));
    	}

    	$task = RICETask::find($task_id);
    	$page_title = $task->title;

    	return view('members.rice.tasks.read')->with('page_title', $page_title)->with('task', $task);
    }

    public function editTask($task_id) {
    	if (RICEHelper::isAuth(Auth::id()) == false) {
    		return redirect(url('/members/rice/enroll'));
    	}

    	$task = RICETask::find($task_id);
    	$page_title = $task->title;

    	return view('members.rice.tasks.edit')->with('page_title', $page_title)->with('task', $task);
    }

    public function updateTask(Request $data) {
    	$task = RICETask::find($data->task_id);
    	$task->title = $data->title;
    	$task->description = $data->description;
    	$task->reach = $data->reach;
    	$task->impact = $data->impact;
    	$task->confidence = $data->confidence;
    	$task->ease = $data->ease;
    	$task->score = (float)($data->reach + $data->impact + $data->confidence) / (float)$data->ease;
    	$task->status = $data->status;
    	$task->save();

    	return redirect(url('/members/rice/view/' . $task->id));
    }

    public function deleteTask(Request $data) {
    	$task = RICETask::find($data->task_id);
    	$task->status = 0;
    	$task->save();

    	return redirect(url('/members/rice'));
    }

    public function enroll() {
    	$page_title = "Enroll into RICE Tool";
    	return view('members.rice.enroll')->with('page_title', $page_title);
    }

    public function createEnrollment(Request $data) {
    	// TODO: Implement this function
    }

    public function stats($user_id) {
    	if (RICEHelper::isAuth(Auth::id()) == false) {
    		return redirect(url('/members/rice/enroll'));
    	}

    	$stats = RICEHelper::viewStats($user_id);
    	$page_title = "View RICE Stats";

    	return view('members.rice.stats');
    }
}

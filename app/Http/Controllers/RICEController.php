<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;

use App\RICETask;
use App\RICEEnrollment;

use App\Custom\RICEHelper;
use App\Custom\StripeHelper;

use Illuminate\Http\Request;

class RICEController extends Controller
{

	public function index() {
		if (RICEHelper::isAuth(Auth::id()) == false) {
    		return redirect(url('/members/rice/enroll'));
    	}

    	$tasks = RICEHelper::getOpenTasks(Auth::id());
    	$page_title = "Your RICE Tasks";
        $page_header = $page_title;

    	return view('members.rice.view')->with('tasks', $tasks)->with('page_title', $page_title)->with('page_header', $page_header);
	}

    public function create_task(Request $data) {
    	$task = new RICETask;
    	$task->user_id = Auth::id();
    	$task->title = $data->title;
    	$task->description = $data->description;
    	$task->reach = $data->reach;
    	$task->impact = $data->impact;
    	$task->confidence = $data->confidence;
    	$task->ease = $data->ease;
    	$task->score = (float)($data->reach * $data->impact * $data->confidence) / (float)$data->ease;
    	$task->status = 1;
    	$task->save();

    	return response()->json(['success' => 'Task successfully created.']);
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

    public function delete_task(Request $data) {
    	$task = RICETask::find($data->task_id);
    	$task->status = 0;
    	$task->save();

    	return response()->json(['success' => 'Task successfully deleted.']);
    }

    public function mark_complete(Request $data) {
        $task = RICETask::find($data->task_id);
        $task->status = 2;
        $task->save();

        return response()->json(['success' => 'Task successfully deleted.']);
    }

    public function start_trial(Request $data) {
        if (RICEEnrollment::where('user_id', Auth::id())->count() == 0) {
            $enrollment = new RICEEnrollment;
            $enrollment->user_id = Auth::id();
            $enrollment->next_payment_date = Carbon::today()->addDays(7);
            $enrollment->customer_id = "N/A";
            $enrollment->subscription_id = "N/A";
            $enrollment->total_revenue = 0;
            $enrollment->status = 2;
            $enrollment->save();

            return redirect(url('/members/rice/'));
        } else {
            // If user has not paid for trial, take to trial expired page.
            // If user has cancelled product, take to reactivation page.
        }
    }

    public function subscribe(Request $data) {
        $subscription_data = array(
            "card_number" => $data->card_number,
            "ccExpiryMonth" => $data->ccExpiryMonth,
            "ccExpiryYear" => $data->ccExpiryYear,
            "cvvNumber" => $data->cvvNumber,
            "email" => Auth::user()->email,
            "plan_id" => "rice"
        );

        $response = StripeHelper::subscribe($subscription_data);

        $enrollment = RICEEnrollment::where('user_id', $user_id)->first();

        if ($response != "error") {
            $enrollment->customer_id = $response[0];
            $enrollment->subscription_id = $response[1];
            $enrollment->next_payment_date = Carbon::today()->addMonth();
            $enrollment->status = 1;
            $enrollment->total_revenue = $enrollment->total_revenue + 4.97;
            $enrollment->save();

            if (Auth::user()->card_id == "") {
                $user = User::find(Auth::id());
                $user->card_id = $response[2];
                $user->save();
            }

            return response()->json('success', 200);
        } else {
            return response()->json($response, 200);
        }
    }

    public function stats($user_id) {
    	if (RICEHelper::isAuth(Auth::id()) == false) {
    		return redirect(url('/members/rice/enroll'));
    	}

    	$stats = RICEHelper::viewStats($user_id);
    	$page_title = "View RICE Stats";

    	return view('members.rice.stats')->with('stats', $stats);
    }
}

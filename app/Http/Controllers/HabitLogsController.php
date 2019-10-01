<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\HabitLog;

use Illuminate\Http\Request;

class HabitLogsController extends Controller
{
    
	/* --------------------- *\
        CRUD Functions
    \* --------------------- */

    public function create(Request $data) {
    	$log = new HabitLog;
    	$log->user_id = $data->user_id;
    	$log->habit_id = $data->habit_id;
    	$log->record_date = Carbon::today();
    	$log->save();

    	return response()->json(true, 200);
    }

    public function read() {
    	return response()->json(HabitLog::find($_GET['log_id'])->toArray(), 200);
    }

    public function update(Request $data) {
    	$log = HabitLog::find($data->log_id);
    	$log->user_id = $data->user_id;
    	$log->habit_id = $data->habit_id;
    	$log->save();

    	return response()->json(true, 200);
    }

    public function delete(Request $data) {
    	$log = HabitLog::find($data->log_id);
    	$log->is_active = 0;
    	$log->save();

    	return response()->json(true, 200);
    }

}

<?php

namespace App\Http\Controllers;

use App\Lead;

use Illuminate\Http\Request;

class LeadsController extends Controller
{
    
	/* --------------------- *\
        CRUD Functions
    \* --------------------- */

    public function create(Request $data) {
    	$lead = new Lead;
    	$lead->email = $data->email;
    	$lead->landing_page_name = $data->landing_page_name;
    	$lead->save();

    	return response()->json(true, 200);
    }

    public function read() {
    	return response()->json(Lead::find($_GET['lead_id'])->toArray(), 200);
    }

    public function update(Request $data) {
    	$lead = Lead::find($data->lead_id);
    	$lead->is_active = $data->is_active;
    	$lead->save();

    	return response()->json(true, 200);
    }

    public function delete(Request $data) {
    	$lead = Lead::find($data->lead_id);
    	$lead->is_active = 0;
    	$lead->save();

    	return response()->json(true, 200);
    }

}

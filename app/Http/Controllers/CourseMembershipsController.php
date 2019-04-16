<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CourseMembership;

class CourseMembershipsController extends Controller
{
    public function create(Request $data) {
    	$membership = new CourseMembership;
    	$membership->user_id = $data->user_id;
    	$membership->course_id = $data->course_id;

    	if (isset($data->customer_id)) {
    		$membership->customer_id = $data->customer_id;
    	}

    	if (isset($data->subscription_id)) {
    		$membership->subscription_id = $data->subscription_id;
    	}

    	if (isset($data->next_payment_date)) {
    		$membership->next_payment_date = $data->next_payment_date;
    	}

    	$membership->save();

    	return $membership->id;
    }

    public function read($membership_id) {
    	$membership = CourseMembership::find($membership_id);
    	$page_title = "Your Membership";
    	$page_header = $page_title;
    	return view('members.view-membership')->with('page_title', $page_title)->with('page_header', $page_header)->with('membership', $membership);
    }

    public function update(Request $data) {
    	$membership = CourseMembership::find($data->membership_id);

    	if (isset($data->customer_id)) {
    		$membership->customer_id = $data->customer_id;
    	}

    	if (isset($data->subscription_id)) {
    		$membership->subscription_id = $data->subscription_id;
    	}

    	if (isset($data->next_payment_date)) {
    		$membership->next_payment_date = $data->next_payment_date;
    	}

    	$membership->save();

    	return true;
    }

    public function delete(Request $data) {
    	$membership = CourseMembership::find($data->membership_id);
    	$membership->is_active = 0;
    	$membership->save();

    	return true;
    }
}

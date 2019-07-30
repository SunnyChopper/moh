<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\BookClubMembership;

use Illuminate\Http\Request;

class BookClubMembershipsController extends Controller
{
    
    public function create(Request $data) {
    	$membership = new BookClubMembership;
    	$membership->user_id = $data->user_id;
    	$membership->customer_id = $data->customer_id;
    	$membership->subscription_id = $data->subscription_id;
        $membership->next_payment_date = Carbon::now()->addMonth();
    	$membership->save();

    	return response()->json(['success' => 'Successfully created membership.'], 200);
    }

    public function read(Request $data) {
    	return response()->json(BookClubMembership::find($data->membership_id)->toArray(), 200);
    }

    public function update(Request $data) {
    	$membership = BookClubMembership::find($data->poll_id);

    	if (isset($data->subscription_id)) {
    		$membership->subscription_id = $data->subscription_id;
    	}

    	if (isset($data->status)) {
    		$membership->status = $data->status;
    	}

        if (isset($data->next_payment_date)) {
            $membership->next_payment_date = $data->next_payment_date;
        }

    	$membership->save();

    	return response()->json(['success' => 'Successfully updated membership.'], 200);
    }

    public function delete(Request $data) {
    	$membership = BookClubMembership::find($data->membership_id);
    	$membership->status = 0;
    	$membership->save();

    	return response()->json(['success' => 'Successfully cancelled membership.'], 200);
    }

}

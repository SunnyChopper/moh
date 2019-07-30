<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Custom\StripeHelper;

class PaymentsController extends Controller
{
    
	public function book_club(Request $data) {
		$stripe_data = array(
			"card_number" => $data->card_number,
			"ccExpiryMonth" => $data->ccExpiryMonth,
			"ccExpiryYear" => $data->ccExpiryYear,
			"cvvNumber" => $data->cvvNumber,
			"email" => $data->email,
			"plan_id" => $data->plan_id
		);

		$return_data = StripeHelper::subscribe($stripe_data);

		return response()->json(['success' => 'Successfully subscribed.', 'data' => $return_data], 200);
	}

}

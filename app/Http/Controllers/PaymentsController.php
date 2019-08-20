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

		if ($return_data == "Your card has insufficient funds.") {
			return response()->json(['error' => 'Error while creating subscription.', 'data' => 'Insufficient funds on your card.'], 200);
		} else if ($return_data == "Your card was declined.") {
			return response()->json(['error' => 'Error while creating subscription.', 'data' => 'Your card was declined.'], 200);
		} else if ($return_data == "Your card has expired.") {
			return response()->json(['error' => 'Error while creating subscription.', 'data' => 'Your card has expired.'], 200);
		} else if ($return_data == "Your card number is incorrect.") {
			return response()->json(['error' => 'Error while creating subscription.', 'data' => 'Your card number is incorrect.'], 200);
		} else if ($return_data == "Your card's security code is incorrect.") {
			return response()->json(['error' => 'Error while creating subscription.', 'data' => "Your card's security code is incorrect."], 200);
		}

		return response()->json(['success' => 'Successfully subscribed.', 'data' => $return_data], 200);
	}

}

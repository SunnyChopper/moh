<?php

namespace App\Custom;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

use Validator;
use Session;
use Auth;

class StripeHelper {
	/* Private global variables */
	private $amount;

	/* Public functions */
	public function __construct($amount = 0) {
		$this->amount = $amount;
	}

	public static function checkout($data) {
		// Get amount from either
		if ($this->amount == 0) {
			$amount = $data["amount"];
		} else {
			$amount = $this->amount;
		}

		// Start by creating a charge
		$stripe = Stripe::make(env('STRIPE_SECRET'));

		try {
			// Create the token
			$token = $stripe->tokens()->create([
				'card' => [
					'number'    => $data["card_number"],
					'exp_month' => $data["ccExpiryMonth"],
					'exp_year'  => $data["ccExpiryYear"],
					'cvc'       => $data["cvvNumber"]
				]
			]);

			if (!isset($token['id'])) {
				\Session::put('error','The Stripe Token was not generated correctly');
				return redirect()->back();
			}

			// Create a customer
			$customer = $stripe->customers()->create([
				"email" => $data["email"]
			]);

			// Create a card for customer
			$card = $stripe->cards()->create($customer["id"], $token["id"]);

			$charge = $stripe->charges()->create([
				'customer' => $customer["id"],
				'currency' => 'USD',
				'amount'   => $amount,
				'description' => $data["description"]
			]);

			if($charge['status'] == 'succeeded') {
				return $customer["id"];
			} else {
				return "error";
			}
		} catch (Exception $e) {
			return $e->getMessage();
		} catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
			return $e->getMessage();
		} catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
			return $e->getMessage();
		}
	}

	public static function subscribe($data) {
		// Get amount from either
		if ($this->amount == 0) {
			$amount = $data["amount"];
		} else {
			$amount = $this->amount;
		}

		// Start by creating a charge
		$stripe = Stripe::make(env('STRIPE_SECRET'));

		try {
			// Create the token
			$token = $stripe->tokens()->create([
				'card' => [
					'number'    => $data["card_number"],
					'exp_month' => $data["ccExpiryMonth"],
					'exp_year'  => $data["ccExpiryYear"],
					'cvc'       => $data["cvvNumber"]
				]
			]);

			if (!isset($token['id'])) {
				\Session::put('error','The Stripe Token was not generated correctly');
				return redirect()->back();
			}

			// Create a customer
			$customer = $stripe->customers()->create([
				"email" => $data["email"]
			]);

			// Create a card for customer
			$card = $stripe->cards()->create($customer["id"], $token["id"]);

			// Subscribe
			$subscription = $stripe->subscriptions()->create($customer["id"], [
				'plan' => $data["plan_id"]
			]);

			if($subscription['status'] == 'active') {
				$return_array = array($customer["id"], $subscription["id"])
				return $return_array;
			} else {
				return "error";
			}
		} catch (Exception $e) {
			return $e->getMessage();
		} catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
			return $e->getMessage();
		} catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
			return $e->getMessage();
		}
	}
}
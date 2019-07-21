<?php

namespace App\Custom;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

use App\User;

use Validator;
use Session;
use Auth;

class StripeHelper {
	private $amount;
	public $stripe;

	/* Public functions */
	public function __construct($amount = 0) {
		$this->amount = $amount;
		$this->stripe = Stripe::make(env('STRIPE_SECRET'));
	}

	public function getPlan($plan_id) {
		return $this->stripe->plans()->find($plan_id);
	}

	public function getPlans() {
		return $this->stripe->plans()->all()["data"];
	}

	public static function checkout($data) {
		// Get amount from either
		if ($this->amount == 0) {
			$amount = $data["amount"];
		} else {
			$amount = $this->amount;
		}

		try {
			// Create the token
			$token = $this->stripe->tokens()->create([
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

			// Check to see if customer already exists
			if (Auth::guest()) {
				// Create a customer
				$customer = $this->stripe->customers()->create([
					"email" => $data["email"]
				]);

				// Create a card for customer
				$card = $this->stripe->cards()->create($customer["id"], $token["id"]);
			} elseif (Auth::user()->customer_id == "" || Auth::user()->customer_id == NULL) {
				// Create a customer
				$customer = $this->stripe->customers()->create([
					"email" => $data["email"]
				]);

				// Create a card for customer
				$card = $this->stripe->cards()->create($customer["id"], $token["id"]);

				// Store customer ID and card ID
				$user = User::find(Auth::id());
				$user->customer_id = $customer["id"];
				$user->card_id = $card["id"];
				$user->save();
			} else {
				$customer = $this->stripe->customers()->find(Auth::user()->customer_id);
			}

			// Create the charge
			$charge = $this->stripe->charges()->create([
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
		try {
			// Check to see if customer already exists
			if (Auth::guest()) {
				// Create the token
				$token = $this->stripe->tokens()->create([
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
				$customer = $this->stripe->customers()->create([
					"email" => $data["email"]
				]);

				// Create a card for customer
				$card = $this->stripe->cards()->create($customer["id"], $token["id"]);
			} elseif (Auth::user()->customer_id == "" || Auth::user()->customer_id == NULL) {
				// Create the token
				$token = $this->stripe->tokens()->create([
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
				$customer = $this->stripe->customers()->create([
					"email" => $data["email"]
				]);

				// Create a card for customer
				$card = $this->stripe->cards()->create($customer["id"], $token["id"]);

				// Store customer ID and card ID
				$user = User::find(Auth::id());
				$user->customer_id = $customer["id"];
				$user->card_id = $card["id"];
				$user->save();
			} else {
				$customer = $this->stripe->customers()->find(Auth::user()->customer_id);
			}

			// Subscribe
			$subscription = $this->stripe->subscriptions()->create($customer["id"], [
				'plan' => $data["plan_id"]
			]);


			if($subscription['status'] == 'active' || $subscription['status'] == 'trialing') {
				$return_array = array(
					"customer_id" => $customer["id"], 
					"subscription_id" => $subscription["id"], 
					"card_id" => $card["id"]
				);
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
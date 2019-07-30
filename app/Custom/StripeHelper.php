<?php

namespace App\Custom;

use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Stripe\Error\Card;

use App\User;

use Validator;
use Session;
use Auth;

class StripeHelper {

	/*
	 *
	 *	Def: Gets plan details
	 *	Args: plan_id -> int
	 * 	Returns: array
	 *
	 */
	public function getPlan($plan_id) {
		$stripe = Stripe::make(env('STRIPE_SECRET'));
		return $stripe->plans()->find($plan_id);
	}

	/*
	 *
	 *	Def: Gets all plans
	 *	Args: none
	 * 	Returns: array
	 *
	 */
	public function getPlans() {
		$stripe = Stripe::make(env('STRIPE_SECRET'));
		return $stripe->plans()->all()["data"];
	}

	/*
	 *
	 *	Def: Create single charge for customer
	 *	Args: data{card_number, ccExpiryMonth, ccExpiryYear, cvvNumber, email, amount, description} -> array
	 * 	Returns: string
	 *
	 */
	public static function checkout($data) {
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

			// Check to see if customer already exists
			if (Auth::guest()) {
				// Create a customer
				$customer = $stripe->customers()->create([
					"email" => $data["email"]
				]);

				// Create a card for customer
				$card = $stripe->cards()->create($customer["id"], $token["id"]);
			} elseif (Auth::user()->customer_id == "" || Auth::user()->customer_id == NULL) {
				// Create a customer
				$customer = $this->stripe->customers()->create([
					"email" => $data["email"]
				]);

				// Create a card for customer
				$card = $stripe->cards()->create($customer["id"], $token["id"]);

				// Store customer ID and card ID
				$user = User::find(Auth::id());
				$user->customer_id = $customer["id"];
				$user->card_id = $card["id"];
				$user->save();
			} else {
				$customer = $stripe->customers()->find(Auth::user()->customer_id);
			}

			// Create the charge
			$charge = $stripe->charges()->create([
				'customer' => $customer["id"],
				'currency' => 'USD',
				'amount'   => $data["amount"],
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

	/*
	 *
	 *	Def: Subscribe user to subscription
	 *	Args: data{card_number, ccExpiryMonth, ccExpiryYear, cvvNumber, email, plan_id} -> array
	 *	Returns: array
	 *
	 */
	public static function subscribe($data) {
		$stripe = Stripe::make(env('STRIPE_SECRET'));

		try {
			// Check to see if customer already exists
			if (Auth::guest()) {
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
			} elseif (Auth::user()->customer_id == "" || Auth::user()->customer_id == NULL) {
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

				// Store customer ID and card ID
				$user = User::find(Auth::id());
				$user->customer_id = $customer["id"];
				$user->card_id = $card["id"];
				$user->save();
			} else {
				$customer = $stripe->customers()->find(Auth::user()->customer_id);
				$card = array(
					"id" => Auth::user()->card_id
				);
			}

			// Subscribe
			$subscription = $stripe->subscriptions()->create($customer["id"], [
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
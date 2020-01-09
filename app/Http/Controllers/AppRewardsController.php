<?php

namespace App\Http\Controllers;

use App\AppReward;
use App\AppUser;

use Illuminate\Http\Request;

class AppRewardsController extends Controller
{
    
	public function create(Request $data) {
		$data = $data["postVariables"];

		$reward = new AppReward;
		$reward->user_id = $data["user_id"];
		$reward->title = $data["title"];
		$reward->description = $data["description"];
		$reward->points = $data["points"];
		$reward->save();

		return response()->json([
			'success' => true,
			'reward' => $reward->toArray()
		], 200);
	}

	public function read() {
		return response()->json([
			'success' => true,
			'reward' => AppReward::find($_GET['reward_id'])->toArray()
		], 200);
	}

	public function update(Request $data) {
		$data = $data["postVariables"];

		$reward = AppReward::find($data["reward_id"]);

		if (isset($data["title"])) {
			$reward->title = $data["title"];
		}

		if (isset($data["description"])) {
			$reward->description = $data["description"];
		}

		if (isset($data["points"])) {
			$reward->points = $data["points"];
		}

		$reward->save();

		return response()->json([
			'success' => true,
			'reward' => $reward->toArray()
		], 200);
	}

	public function delete(Request $data) {
		$data = $data["postVariables"];

		$reward = AppReward::find($data["reward_id"]);
		$reward->is_active = 0;
		$reward->save();

		return response()->json([
			'success' => true
		], 200);
	}

	public function redeem(Request $data) {
		$data = $data["postVariables"];

		$user = AppUser::find($data["user_id"]);
		$reward = AppReward::find($data["reward_id"]);

		if ($user->points >= $reward->points) {
			$user->points = $user->points - $reward->points;
			$user->save();

			return response()->json([
				'success' => true,
				'points' => $user->points
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'You do not have any enough points. Complete some tasks to reward yourself.'
			], 200);
		}
	}

	public function getForUser() {
		$count = AppReward::where('user_id', $_GET['user_id'])->active()->count();
		$rewards = AppReward::where('user_id', $_GET['user_id'])->active()->get()->toArray();

		$returnRewards = array();
		$rewardIDs = array();

		foreach ($rewards as $reward) {
			$returnRewards[$reward["id"]] = $reward;
			array_push($rewardIDs, $reward["id"]);
		}

		return response()->json([
			'success' => true,
			'count' => $count,
			'rewards' => $returnRewards,
			'reward_ids' => $rewardIDs
		], 200);
	}

}

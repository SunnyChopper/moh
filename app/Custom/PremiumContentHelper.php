<?php

namespace App\Custom;

use App\PremiumContent;

class PremiumContentHelper {
	/* Private global variables */
	private $id;

	/* Constructor */
	public function __construct($id = 0) {
		$this->id = $id;
	}

	/* Public functions */
	public function create($data) {
		// Get data and save
		$premium_content = new PremiumContent;
		$premium_content->title = $data["title"];
		$premium_content->body = $data["body"];
		$premium_content->featured_image_url = $data["featured_image_url"];
		$premium_content->youtube_video_id = $data["youtube_video_id"];
		$premium_content->save();

		// Return the ID of the premium content
		return $premium_content->id;
	}

	public function read($id = 0) {
		// Check to see if no ID passed in
		if ($id == 0) {
			$id = $this->id;
		}

		// Return the blog post object
		return PremiumContent::find($id);
	}

	public function update($data) {
		// Get data and update
		$premium_content = PremiumContent::find($data["premium_content_id"]);
		$premium_content->title = $data["title"];
		$premium_content->body = $data["body"];
		$premium_content->featured_image_url = $data["featured_image_url"];
		$premium_content->youtube_video_id = $data["youtube_video_id"];
		$premium_content->save();
	}

	public function delete($id = 0) {
		// Check to see if no ID passed in
		if ($id == 0) {
			$id = $this->id;
		}

		// Delete
		$premium_content = PremiumContent::find($id);
		$premium_content->is_active = 0;
		$premium_content->save();
	}

	public function get_all() {
		return PremiumContent::where('is_active', 1)->get();
	}

	public function get_all_with_pagination($pagination) {
		return PremiumContent::where('is_active', 1)->paginate($pagination);
	}
}
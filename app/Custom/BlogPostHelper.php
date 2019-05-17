<?php

namespace App\Custom;

use App\BlogPost;

class BlogPostHelper {
	/* Private global variables */
	private $id;

	/* Constructor */
	public function __construct($id = 0) {
		$this->id = $id;
	}

	/* Public functions */
	public function create($data) {
		$blog_post = new BlogPost;
		$blog_post->author_id = $data["author_id"];
		$blog_post->title = $data["title"];
		$blog_post->body = $data["body"];
		$blog_post->featured_image_url = $data["featured_image_url"];
		$blog_post->slug = $data["slug"];

		if (isset($data["is_active"])) {
			$blog_post->is_active = $data["is_active"];
		}

		$blog_post->save();

		return $blog_post->id;
	}

	public function read($id = 0) {
		if ($id == 0) {
			$id = $this->id;
		}

		return BlogPost::find($id);
	}

	public function update($data) {
		$blog_post = BlogPost::find($data["post_id"]);
		$blog_post->title = $data["title"];
		$blog_post->body = $data["body"];
		$blog_post->featured_image_url = $data["featured_image_url"];
		$blog_post->slug = $data["slug"];

		if (isset($data["is_active"])) {
			$blog_post->is_active = $data["is_active"];
		}

		$blog_post->save();
	}

	public function delete($id = 0) {
		if ($id == 0) {
			$id = $this->id;
		}

		$blog_post = BlogPost::find($id);
		$blog_post->is_active = 0;
		$blog_post->save();
	}

	public function get_all() {
		return BlogPost::where('is_active', 1)->get();
	}

	public function get_all_with_pagination($pagination) {
		return BlogPost::where('is_active', 1)->paginate($pagination);
	}

	public function get_all_from_author($author_id) {
		return BlogPost::where('author_id', $author_id)->where('is_active', '>=', 1)->get();
	}
}
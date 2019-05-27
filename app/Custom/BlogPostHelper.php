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
		// Get data and save
		$blog_post = new BlogPost;
		$blog_post->author_id = $data["author_id"];
		$blog_post->title = $data["title"];
		$blog_post->body = $data["body"];
		$blog_post->featured_image_url = $data["featured_image_url"];
		$blog_post->slug = $data["slug"];
		$blog_post->save();

		// Return the ID of the blog post
		return $blog_post->id;
	}

	public function read($id = 0) {
		// Check to see if no ID passed in
		if ($id == 0) {
			$id = $this->id;
		}

		// Return the blog post object
		return BlogPost::find($id);
	}

	public function update($data) {
		// Get data and update
		$blog_post = BlogPost::find($data["post_id"]);
		$blog_post->title = $data["title"];
		$blog_post->body = $data["body"];
		$blog_post->featured_image_url = $data["featured_image_url"];
		$blog_post->slug = $data["slug"];
		$blog_post->save();
	}

	public function delete($id = 0) {
		// Check to see if no ID passed in
		if ($id == 0) {
			$id = $this->id;
		}

		// Delete
		$blog_post = BlogPost::find($id);
		$blog_post->is_active = 0;
		$blog_post->save();
	}

	public function get_all() {
		return BlogPost::where('is_active', 1)->orderBy('created_at', 'DESC')->get();
	}

	public function get_all_with_pagination($pagination) {
		return BlogPost::where('is_active', 1)->orderBy('created_at', 'DESC')->paginate($pagination);
	}

	public static function get_recent() {
		return BlogPost::where('is_active', 1)->orderBy('created_at', 'DESC')->limit(3)->get();
	}

	public function get_all_from_author($author_id) {
		return BlogPost::where('author_id', $author_id)->where('is_active', 1)->get();
	}
}
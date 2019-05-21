<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Custom\BlogPostHelper;

use Auth;
use Session;

use App\User;

class BlogPostsController extends Controller
{

    /* Public Basic CRUD Functions */
    public function create(Request $data) {
        // Get data and create
    	$blog_post_helper = new BlogPostHelper();
    	$post_data = array(
    		"author_id" => Auth::id(),
    		"title" => $data->title,
    		"body" => $data->body,
    		"slug" => $data->slug,
    		"featured_image_url" => $data->featured_image_url
    	);
    	$blog_post_helper->create($post_data);

        // Redirect to admin view
    	return redirect(url('/admin/posts'));
    }

    public function read($post_id, $slug) {
        // Get post
        $blog_post_helper = new BlogPostHelper($post_id);
        $post = $blog_post_helper->read();

        // Dynamic page features
        $page_header = $post->title;
        $page_title = $post->title;

        // Return view
        return view('pages.view-post')->with('page_title', $page_title)->with('page_header', $page_header)->with('post', $post);
    }

    public function update(Request $data) {
        // Get data and update
    	$blog_post_helper = new BlogPostHelper();
    	$post_data = array(
    		"post_id" => $data->post_id,
    		"title" => $data->title,
    		"body" => $data->body,
    		"slug" => $data->slug,
    		"featured_image_url" => $data->featured_image_url
    	);
    	$blog_post_helper->update($post_data);

        // Redirect to admin view
    	return redirect(url('/admin/posts'));
    }

    public function delete(Request $data) {
        // Get data and delete
    	$blog_post_helper = new BlogPostHelper($data->post_id);
    	$blog_post_helper->delete();

        // Redirect to admin view
    	return redirect(url('/admin/posts'));
    }

    /* Public Admin CRUD Functions */
    public function view_blog_posts() {
        // Dynamic page features
        $page_header = "Blog Posts";

        // Protect admin backend
        $this->protect();

        // Get posts
        $blog_post_helper = new BlogPostHelper();
        $posts = $blog_post_helper->get_all();

        // Return view
        return view('admin.posts.view')->with('page_header', $page_header)->with('posts', $posts);
    }

    public function new_blog_post() {
        // Dynamic page features
        $page_header = "New Blog Post";

        // Protect admin backend
        $this->protect();

        // Return view
        return view('admin.posts.new')->with('page_header', $page_header);
    }

    public function edit_blog_post($post_id) {
        // Dynamic page features
        $page_header = "Edit Blog Post";

        // Protect admin backend
        $this->protect();

        // Get post
        $blog_helper = new BlogPostHelper($post_id);
        $post = $blog_helper->read();

        // Return view
        return view('admin.posts.edit')->with('page_header', $page_header)->with('post', $post);
    }

    /* Public Basic View Functions */
    public function blog() {
        // Dynamic page features
        $page_header = "Blog";
        $page_title = "Blog";

        // Get posts
        $blog_post_helper = new BlogPostHelper();
        $posts = $blog_post_helper->get_all_with_pagination(10);

        // Return view
        return view('pages.blog')->with('page_header', $page_header)->with('page_title', $page_title)->with('posts', $posts);
    }

    /* Private helper functions */
    private function protect() {
        if (Session::has('admin_login')) {
            if (Session::get('admin_login') == false) {
                return redirect(url('/admin'));
            }
        } else {
            return redirect(url('/admin'));
        }
    }

}

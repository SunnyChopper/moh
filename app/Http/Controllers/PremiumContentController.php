<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Custom\PremiumContentHelper;

use Auth;
use Session;

use App\User;

class PremiumContentController extends Controller
{

    /* Public Basic CRUD Functions */
    public function create(Request $data) {
        // Get data and create
    	$premium_content_helper = new PremiumContentHelper();
    	$content_data = array(
    		"title" => $data->title,
    		"body" => $data->body,
    		"featured_image_url" => $data->featured_image_url
    	);

        // Parse YouTube video URL if not empty
        if ($data->youtube_video_url != "") {
            parse_str(parse_url( $data->youtube_video_url, PHP_URL_QUERY ), $youtube_vars);
            $content_data["youtube_video_id"] = $youtube_vars['v'];
        } else {
            $content_data["youtube_video_id"] = "";
        }

    	$premium_content_helper->create($content_data);

        // Redirect to admin view
    	return redirect(url('/admin/premium/view'));
    }

    public function read($content_id) {
        // Get premium content
        $premium_content_helper = new PremiumContentHelper($content_id);
        $content = $premium_content_helper->read();

        // Dynamic page features
        $page_header = $content->title;
        $page_title = $content->title;

        // Return view
        return view('members.view-premium-content')->with('page_title', $page_title)->with('page_header', $page_header)->with('content', $content);
    }

    public function update(Request $data) {
        // Get data and create
        $premium_content_helper = new PremiumContentHelper();
        $content_data = array(
            "premium_content_id" => $data->premium_content_id,
            "title" => $data->title,
            "body" => $data->body,
            "featured_image_url" => $data->featured_image_url
        );

        // Parse YouTube video URL if not empty
        if ($data->youtube_video_url != "") {
            parse_str(parse_url( $data->youtube_video_url, PHP_URL_QUERY ), $youtube_vars);
            $content_data["youtube_video_id"] = $youtube_vars['v'];
        } else {
            $content_data["youtube_video_id"] = "";
        }

    	$premium_content_helper->update($content_data);

        // Redirect to admin view
    	return redirect(url('/admin/premium/view'));
    }

    public function delete(Request $data) {
        // Get data and delete
    	$blog_post_helper = new BlogPostHelper($data->post_id);
    	$blog_post_helper->delete();

        // Redirect to admin view
    	return redirect(url('/admin/premium/view'));
    }

    /* Public Admin CRUD Functions */
    public function view_premium_content() {
        // Dynamic page features
        $page_header = "Premium Content";
        $page_title = $page_header . " - " . env('APP_NAME');

        // Protect admin backend
        $this->protect();

        // Get posts
        $premium_content_helper = new PremiumContentHelper();
        $premium_content = $premium_content_helper->get_all();

        // Return view
        return view('admin.premium-content.view')->with('page_title', $page_title)->with('page_header', $page_header)->with('premium_content', $premium_content);
    }

    public function new_premium_content() {
        // Dynamic page features
        $page_header = "New Premium Content";
        $page_title = $page_header . " - " . env('APP_NAME');

        // Protect admin backend
        $this->protect();

        // Return view
        return view('admin.premium-content.new')->with('page_title', $page_title)->with('page_header', $page_header);
    }

    public function edit_premium_content($content_id) {
        // Dynamic page features
        $page_header = "Edit Premium Content";
        $page_title = $page_header . " - " . env('APP_NAME');

        // Protect admin backend
        $this->protect();

        // Get post
        $premium_content_helper = new PremiumContentHelper($content_id);
        $content = $premium_content_helper->read();

        // Return view
        return view('admin.premium-content.edit')->with('page_title', $page_title)->with('page_header', $page_header)->with('post', $post);
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

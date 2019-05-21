@extends('layouts.app')

@section('content')
	@include('layouts.banner')

	<div class="container mt-64 mb-64">
		<div class="row">
			<div class="col-lg-10 offset-lg-1 col-md-10 offset-md-1 col-sm-12 col-xs-12">
				<form action="/admin/posts/update" method="post" id="edit_blog_post_form">
					{{ csrf_field() }}
					<input type="hidden" value="{{ $post->id }}" name="post_id">
					<div class="form-group mb-64">
						<h5>Title:</h5>
						<p class="mb-2">This will be the title of the post that will show up on the blog.</p>
						<input type="text" name="title" value="{{ $post->title }}" class="form-control" required>
					</div>

					<div class="form-group mb-64">
						<h5>Slug:</h5>
						<p class="mb-2">This is the part that will go into the URL, so make it SEO friendly.</p>
						<input type="text" name="slug" value="{{ $post->slug }}" class="form-control" required>
					</div>

					<div class="form-group mb-64">
						<h5>Featured Image URL:</h5>
						<p class="mb-2">This is the image that will be used as the cover photo for this post.</p>
						<input type="text" name="featured_image_url" value="{{ $post->featured_image_url }}" class="form-control" required>
					</div>

					<div class="form-group mb-64">
						<h5>Body:</h5>
						<p class="mb-2">This is the body of the post. Here's a nice little editor to make things easy.</p>
						<textarea id="blog_textarea" name="body" class="form-control" rows="15" form="edit_blog_post_form">{{ $post->body }}</textarea>
					</div>

					<div class="form-group">
						<input type="submit" value="Update Post" class="btn btn-success">
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script src='https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xq9hzw57g3zkmakqchurmgo9hnprenmg1yopn8cirghphy2x'></script>
	<script type="text/javascript">
		tinymce.init({
			selector: '#blog_textarea',
			plugins: "code"
		});
	</script>
@endsection